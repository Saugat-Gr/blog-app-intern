<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $user = User::create([
    'name' => "Saugat Gurung",
    'email' => "gurungSaugat@gmail.com",
    'user_name' => "saugat_san",
    'password' => bcrypt("password"),
    'date_of_birth' => '2000-01-01',
    'status' => UserStatus::ACTIVE,
]);

$user->assignRole('admin');
        }
}
