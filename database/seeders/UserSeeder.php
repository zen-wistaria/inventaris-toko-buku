<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Admin',
            'email' => 'admin112233@gmail.com',
            'password' => bcrypt('admin112233'),
            'role' => 0,
            'email_verified_at' => now(),
        ];
        $pengelola = [
            'name' => 'Pengelola',
            'email' => 'pengelola112233@gmail.com',
            'password' => bcrypt('pengelola112233'),
            'role' => 0,
            'email_verified_at' => now(),
        ];
        $kasir = [
            'name' => 'Kasir',
            'email' => 'kasir112233@gmail.com',
            'password' => bcrypt('kasir112233'),
            'role' => 0,
            'email_verified_at' => now(),
        ];
        User::create($admin)
            ->create($pengelola)
            ->create($kasir);
    }
}
