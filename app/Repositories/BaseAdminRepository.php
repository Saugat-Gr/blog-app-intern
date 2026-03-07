<?php

namespace App\Repositories;

use App\Enums\UserStatus;
use App\Models\User;
use App\Repositories\Interfaces\BaseAdminRepositoryInterface;

class BaseAdminRepository  implements BaseAdminRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUsersByStatus(string $status)
    {
        return $status === 'all' ? User::all() : User::where('status', $status)->get();
    }

    public function destroyUser(User $user)
    {
        return $user->delete();
    }

    public function suspendUser(User $user)
    {
        $user->status = UserStatus::SUSPENDED;
        return $user->save();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(User $user, array $data)
    {
        return $user->update($data);
    }

    public function getRecentUsers(UserStatus $status, int $limit)
    {
        return User::where('status', $status)
            ->latest()
            ->take($limit)
            ->get();
    }

    public function countAllUsers()
    {
        return User::count();
    }

    public function countAllUsersByStatus(UserStatus $status)
    {
        return User::where('status', $status)->count();
    }
}