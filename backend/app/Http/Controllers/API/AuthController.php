<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller {
    /**
     * User Registration
     */
    public function register(RegisterRequest $request) {

        $user = User::create($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,
        ], 201);

    }
    /**
     * User Login
     */

    public function login(LoginRequest $request) {

        // $user = User::where('email', $request->email)->first();

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // If credentials are correct, authenticate and create token
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Login successfull',
            'user'    => $user,
            'token'   => $token,
        ], 200);
    }

    /**
     * Send Password Reset Link
     */
    public function sendResetLinkEmail(Request $request) {
        // Validate the request
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return response()->json(['message' => 'No user found with that email address.'], 404);
        }

        // Generate a random token
        $token = $this->generateToken();

        // Store the token in the password_reset_tokens table
        $this->storeResetToken($request->email, $token);

        // Send the password reset email
        $this->sendPasswordResetEmail($request->email, $token);

        return response()->json(['message' => 'Password reset link has been sent to your email.'], 200);
    }

    private function generateToken(): string {
        return Str::random(40);
    }

    private function storeResetToken(string $email, string $token): void {
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email], // Conditions: Find a record with this email
            [
                'token'      => hash_hmac('sha256', $token, config('app.key')), // Values: Update or insert this token
                'created_at' => Carbon::now(),
            ],

        );
    }

    private function sendPasswordResetEmail(string $email, string $token): void {
        try {
            Mail::to($email)->send(new ForgetPasswordMail($token, $email));

        } catch (Exception $exception) {
            Log::error('Failed to send password reset email', ['email' => $email, 'error' => $exception->getMessage()]);
        }
    }

    /**
     * Reset Password
     */

    public function passwordReset(PasswordResetRequest $request) {

        if (! User::isValidEmail($request->email)) {
            return response()->json(['message' => 'No password reset request found for this email'], 400);
        }

        if (! User::isValidToken($request->email, $request->token)) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }

        $user = User::where('email', $request->email)->first();

        $user->resetPassword($request->password);

        User::deleteToken($request->email);

        Log::info('Password reset successful for user: ' . $user->email);

        return response()->json(['message' => 'Password reset successfully'], 200);

    }


    public function userProfile(Request $request) {
        return response()->json([
           'user' => auth()->guard('api')->user(), // OR use auth('api')->user()
        ], 200);
    }


    public function logout(Request $request) {
        // Revoke the user's token
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    /**
     * Email Verification
     */

    // public function verifyEmail(Request $request, $id, $hash) {

    //     $user = User::findOrFail($id);

    //     if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
    //         return response()->json(['message' => 'Invalid verification link.'], 403);
    //     }
    //     if ($user->hasVerifiedEmail()) {
    //         return response()->json(['message' => 'Email already verified.'], 200);
    //     }
    //     if ($user->markEmailAsVerified()) {
    //         event(new Verified($user));
    //     }

    //     return response()->json(['message' => 'Email verified successfully']);
    // }

    /**
     * Resend Verification Email
     */

    // public function resendVerificationEmail(Request $request) {

    //     $request->validate(['email' => 'required|email']);

    //     $user = User::where('email', $request->email)->first();

    //     if (! $user) {
    //         return response()->json(['message' => 'User not found.'], 404);
    //     }

    //     if ($user->hasVerifiedEmail()) {
    //         return response()->json(['message' => 'Email already verified.'], 200);
    //     }
    //     $user->sendEmailVerificationNotification();

    //     return response()->json(['message' => 'Verification email resent.']);
    // }



}
