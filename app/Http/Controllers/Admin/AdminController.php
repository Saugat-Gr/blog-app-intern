<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditUserRequest;
use App\Models\User;
use App\Models\UserRequest;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;

class AdminController extends Controller
{
      use ToastrTrait;


    public function __construct()  {
         $this->middleware("auth.check");
    }


     public function dashboard(){

        $totalUsers = User  ::count();
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'in-active')->count();
        $suspendedUsers = User::where('status', 'suspended')->count();

        $recentUsers = User::latest()->where('status', 'active')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'recentUsers'
        ));
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.users', compact('users'));
    }

   
    public function create()
    {
        //
    }

   
    public function store()
    {
        //
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show(User $user)
    {
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit($id)
    {
        $user = User::find($id);
         return view('admin.admin-edit', compact('user'));
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update($id)
    {
        //
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    {
        //
    }

    public function renderUserRequest(){

           $requests = UserRequest::with('user')->where('status', '!=', 'approved')->get();

           return view('admin.user.UserRequest', compact('requests'));
    }

     public function accUserRequest(UserRequest $userRequest){
     
             if($userRequest->status === "pending"){
              $userRequest->status = "approved";

              $userRequest->save();
              $user = $userRequest->user;
              $user->status = UserStatus::ACTIVE;

              $user->save();

              return redirect()->route("admin.dashboard");
             }

     }

      public function declineUserRequest(UserRequest $userRequest){
     
             if($userRequest->status === "pending"){
              $userRequest->status = "rejected";

              $userRequest->save();

              return redirect()->route("admin.dashboard");
             }

     }

     public function filterUsers(Request $request){

      $status = $request->query('status');

      $users = $status === 'all' ? User::all() : User::where('status', $status)->get();

      return view('admin.user._user-cards', compact('users')); 

     }

     public function destroyUser(User $user){
          $user->delete();

          return redirect()->route('admin.dashboard');
     }

     public function suspendUser(User $user){
     
          $user->status = UserStatus::SUSPENDED;
          $user->save();

         return redirect()->route('admin.dashboard');

     }


     public function createUser(){
        $statuses = UserStatus::cases();
           return view('admin.user.create', compact('statuses')); 
     }


     public function editUser(User $user){
          $statuses = UserStatus::cases();
          return view('admin.user.edit', compact('user', 'statuses'));
     }

     public function updateUser(AdminEditUserRequest $request, User $user){
     
            $validated_data = $request->validated();

              $user->update(
                [
                     'name' => $validated_data['name'],
                     'user_name' => $validated_data['user_name'],
                     'status' => $validated_data['status'],
                     'role' => $validated_data['role'],
                     'date_of_birth' => $validated_data['date_of_birth'],
                ]
              );

              return redirect()->route('admin.index');
     }

}
