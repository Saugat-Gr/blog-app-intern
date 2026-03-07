<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function showAllUsers()
    {
      $superAdmin = User::role('super-admin')->first();

        $users = User::role(['editor','user'])->except(auth()->user())->get();

        return [
            'superAdmin' => $superAdmin,
            'users' => $users
        ];
    }

    public function updateUser(User $user, array $data){
        $user->update($data);

        return $user;
    }

}