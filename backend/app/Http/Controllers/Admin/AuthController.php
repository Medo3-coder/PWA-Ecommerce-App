<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Show the admin login page
     */
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    /**
     * Admin Login
     */
    public function loginAdmin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
        $user = Auth::user();
        if ($user->role !== 'admin') {
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'Not an admin account'])->withInput();
        }
        // Success: redirect to admin dashboard
        return redirect()->route('admin.dashboard');
    }

    /**
     * Admin Registration
     */
    public function registerAdmin(RegisterRequest $request)
    {
        // Only allow if current user is admin
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data         = $request->validated();
        $data['role'] = 'admin';
        $user         = User::create($data);
        return response()->json([
            'message' => 'Admin registered successfully',
            'user'    => $user,
        ], 201);
    }

    /**
     * Admin Profile Update
     */
    public function updateAdminProfile(Request $request)
    {
        $user = auth()->user();
        if (! $user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $user->update($request->only(['name', 'email', 'phone', 'address', 'city', 'state', 'country', 'postal_code']));
        return response()->json(['message' => 'Profile updated', 'user' => $user], 200);
    }

    /**
     * Admin Change Password
     */
    public function changeAdminPassword(Request $request)
    {
        $user = auth()->user();
        if (! $user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:6|confirmed',
        ]);
        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }
        $user->password = $request->password;
        $user->save();
        return response()->json(['message' => 'Password changed successfully'], 200);
    }
}
