<?php

namespace App\Repositories\Interfaces;
use App\Enums\UserStatus;
use App\Models\User;

interface AdminRepositoryInterface
{
    public function getAllUsers();

    public function getUsersByStatus(string $status);

    public function destroyUser(User $user);

    public function suspendUser(User $user);

    public function createUser(array $data);

    public function updateUser(User $user, array $data);

    public function getRecentUsers(UserStatus $status, int $limit);
    public function countAllUsers();

    public function countAllUsersByStatus(UserStatus $status);
}
