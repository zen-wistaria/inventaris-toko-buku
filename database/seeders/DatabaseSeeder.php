<?php

namespace Database\Seeders;

use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\BookItem;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        TransactionDetail::factory(200)->recycle([
            Transaction::factory(50)->create(),
            Book::factory(20)->create()
        ])->create();
        BookItem::factory(100)->recycle(Book::factory(10)->create())->create();
        User::factory(25)->create();
    }
}
