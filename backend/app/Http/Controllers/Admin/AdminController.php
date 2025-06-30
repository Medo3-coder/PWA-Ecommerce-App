<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Admin profile
     */

    public function AdminProfile()
    {
        $user = auth()->user();
        if (! $user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return view('admin.profile.profile')->with('user', $user);
    }

    /**
     * Admin Profile Update
     */
    public function updateAdminProfile(UpdateProfileRequest $request)
    {
        // dd(request()->all());
        $user = auth()->user();
        if (! $user || ! in_array($user->role, ['admin'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data = $request->validated(); // 🔐 Only validated data
        // if (! empty($data['password'])) {
        //     $data['password'] = $request->password;
        // } else {
        //     unset($data['password']); // Remove password if not provided
        // }
        $user->update($data);
        $user->refresh();

        return response()->json(['message' => 'Profile updated successfully.', 'user' => $user], 200);
    }


    public function changePassword()
    {
        $user = auth()->user();
        return view('admin.profile.change_password', compact('user'));
    }

    /**
     * Admin update Password
     */
    public function updatePassword(Request $request)
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

    /**
     * Admin Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
