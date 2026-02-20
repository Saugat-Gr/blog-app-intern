<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()  {
         $this->middleware("auth.check");
    }


     public function dashboard(){

        $totalUsers = User  ::count();
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = User::where('status', 'in-active')->count();
        $suspendedUsers = User::where('status', 'suspended')->count();

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'activeUsers', 'inactiveUsers', 'suspendedUsers', 'recentUsers'
        ));
    }

    public function index()
    {
        //
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
    public function show($id)
    {
        //
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit($id)
    {
        //
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

    public function userRequest(){


           $requests = UserRequest::where('status', 'pending')->get();


           return view('admin.UserRequest', compact('requests'));
    }

}
