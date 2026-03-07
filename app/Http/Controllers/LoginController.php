<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Jobs\ValidateAndCreateUser;
use App\Models\User;
use App\Models\UserRequest;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Prompts\Concerns\Fallback;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\returnArgument;

class LoginController extends Controller
{
    use ToastrTrait;

   public function showLoginForm(){

      return auth()->user() ? redirect()->route('dashboard') : redirect()->route('login');
       
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

        $this->toastrSuccess('You have successfully logged in!');

      return (auth()->user()->role(['admin', 'super-admin'] )) ? redirect()->route('admin.dashboard'):redirect()->route('user.index');
   
    }
      return redirect()->back()->withErrors([
        'invalid-login' => 'The login credentials donot match our records'], 'log-in');
 }


   public function register(RegisterUserRequest $request){
   
        $validated_data = $request->validated();


        ValidateAndCreateUser::dispatch($validated_data);

        $this->toastrInfo('Your registration is being processed...');

       return redirect()->back();
   }

   public function logout(){

        if(Auth::user()){
           Auth::logout();

           $this->toastrSuccess('You have been logged out.');
           return redirect()->route('auth.login');
        }

   }

}
