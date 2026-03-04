<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $token = \Str::random(64);

        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]); 

        $resetUrl = url('/reset-password?token=' . $token . '&email=' . $request->email);

        \Mail::to($request->email)->send(new ResetPasswordMail($resetUrl));

        
    }
}
