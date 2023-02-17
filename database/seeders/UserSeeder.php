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
        collect([
            [
                'name' => 'admin',
                'email' => 'admin@test.test',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'user',
                'email' => 'user@test.test',
                'password' => Hash::make('password'),
            ],
        ])->each(function($users) {
            $user = User::create($users);
            $user->id === 1 ? $user->assignRole('admin') : $user->assignRole('user');
        });
    }
}
