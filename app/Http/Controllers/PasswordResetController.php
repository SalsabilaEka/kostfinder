<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function updateDirect(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Password has been changed successfully!');
    }

    return back()->withErrors(['email' => 'User not found']);
}
}
