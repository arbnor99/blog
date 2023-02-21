<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Arbnor Gashi',
                'email' => 'arbnor@gmail.com',
                'password' => Hash::make('password')
            ]
        ];

        foreach($users as $user) {
            User::create($user);
        }
    }
}
