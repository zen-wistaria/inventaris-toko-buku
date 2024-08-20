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
            'email' => 'admin112233@gmail.com',
            'address' => 'Sukajaya, Purbaratu, Kota Tasikmalaya',
            'password' => bcrypt('admin'),
            'role' => 0,
            'email_verified_at' => now(),
        ];
        $pengelola = [
            'name' => 'Pengelola',
            'username' => 'pengelola112233',
            'email' => 'pengelola112233@gmail.com',
            'address' => 'Sukajaya, Purbaratu, Kota Tasikmalaya',
            'password' => bcrypt('pengelola112233'),
            'role' => 1,
            'email_verified_at' => now(),
        ];
        $kasir = [
            'name' => 'Kasir',
            'username' => 'kasir112233',
            'email' => 'kasir112233@gmail.com',
            'address' => 'Sukajaya, Purbaratu, Kota Tasikmalaya',
            'password' => bcrypt('kasir112233'),
            'role' => 2,
            'email_verified_at' => now(),
        ];
        User::create($admin)
            ->create($pengelola)
            ->create($kasir);
    }
}
