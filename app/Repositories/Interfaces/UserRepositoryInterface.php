<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function showAllUsers();

    public function updateUser(User $user, array $data);

}
