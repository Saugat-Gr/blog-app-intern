<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Saugat Gurung";
        $user->email ="gurungSaugat@gmail.com";
        $user->user_name = "saugat_san";
        $user->password = bcrypt("password");
        $user->save();
    }
}
