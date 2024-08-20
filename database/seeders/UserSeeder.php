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
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => 'Sukajaya, Purbaratu, Kota Tasikmalaya',
            'password' => bcrypt('admin'),
            'role' => 0,
            'email_verified_at' => now(),
        ];
        $pengelola = [
            'name' => 'Pengelola',
            'username' => 'pengelola',
            'email' => 'pengelola@gmail.com',
            'address' => 'Sukajaya, Purbaratu, Kota Tasikmalaya',
            'password' => bcrypt('pengelola'),
            'role' => 1,
            'email_verified_at' => now(),
        ];
        $kasir = [
            'name' => 'Kasir',
            'username' => 'kasir',
            'email' => 'kasir@gmail.com',
            'address' => 'Sukajaya, Purbaratu, Kota Tasikmalaya',
            'password' => bcrypt('kasir'),
            'role' => 2,
            'email_verified_at' => now(),
        ];
        User::create($admin)
            ->create($pengelola)
            ->create($kasir);
    }
}
