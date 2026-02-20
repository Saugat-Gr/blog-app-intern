<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Prompts\Concerns\Fallback;
use function PHPUnit\Framework\returnArgument;

class LoginController extends Controller
{

   public function showLoginForm(){
      return view('auth.login');
   }


   public function authenticate(LoginRequest $request){
   
      $validated_data = $request->validated();


       $login_type = filter_var($validated_data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';


    if (Auth::attempt([
         $login_type => $validated_data['login'],
         'password' => $validated_data['password'],
         'status' => 'active'
    ])) {
        $request->session()->regenerate();

      if(Gate::allows('isAdmin')){
        return redirect()->route('admin.dashboard');
    }else{
      return redirect()->route('user.index');
    }
    
    }
      return redirect()->back()->withErrors([
        'invalid-login' => 'The login credentials donot match our records'], 'log-in');
 }


   public function register(RegisterUserRequest $request){
   
        $validated_data = $request->validated();

        $user = User::create([
            'name'=> $validated_data['name'],
            'email'=> $validated_data['email'],
            'password'=> bcrypt($validated_data['password']),
            'status' => 'in-active',
            'user_name' => $validated_data['user_name'],
         ]);

         $user_request = UserRequest::create([
              'user_id' => $user->id,
              'status' => 'pending'
         ]);

          return redirect()->back()->with('success', 'Your request has been submitted. Please wait for admin approval.');
   }

   public function logout(){

        if(Auth::user()){
           Auth::logout();

           return redirect()->route('auth.login');
        }

   }

}
