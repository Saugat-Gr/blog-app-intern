<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;


class ForgotPasswordController extends Controller
{
   public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ]);

    $user = User::where('email', $request->email)->first();

    // Create token and store in password_resets table
    $token = Str::random(64);
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $user->email],
        [
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]
    );

    // Create reset URL (send raw token)
    $resetUrl = url('/reset-password/' . $token . '?email=' . $user->email);

    Mail::to($user->email)->send(new ResetPasswordMail($resetUrl));

    return back()->with('success', 'Password reset link sent to your email.');
}
}
