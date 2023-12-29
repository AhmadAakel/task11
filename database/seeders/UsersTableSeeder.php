<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'ahmad',
            'email'=> 'ahmad@test.com',
            'password'=>Hash::make('password'),
            'image' => 'admin.png',
            'is_admin' => true,
            
        ]);
    }
}
