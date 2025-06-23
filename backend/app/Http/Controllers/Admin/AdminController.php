<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

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
