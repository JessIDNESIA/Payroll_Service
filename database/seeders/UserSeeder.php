<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun untuk Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $admin->assignRole('admin');


        // Akun untuk Penulis
        $penulis = User::create([
            'name' => 'Penulis',
            'email' => 'penulis@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $penulis->assignRole('user');
    }
}
