<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\BookItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use App\Models\TransactionDetail;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(auth()->user()->role);
        $books = Book::latest();
        $totalBooks = clone $books;
        $totalBooks = $totalBooks->count();
        $totalBookItems = clone $books;
        $totalBookItems = $totalBookItems->sum('stock');
        $monitorStock = clone $books;
        $monitorStok = $monitorStock->where('stock', '<=', 5);

        $booksIn = BookItem::latest();
        $totalBooksIn = clone $booksIn;
        $totalBooksIn = $totalBooksIn->sum('total_books');

        $transactions = Transaction::latest();
        $totalTransactions = clone $transactions;
        $totalTransactions = $totalTransactions->count();
        $totalIncomes = clone $transactions;
        $totalIncomes = Number::currency($totalIncomes->sum('total_price'), in: 'IDR', locale: 'id');

        $transactionsDetail = TransactionDetail::latest();
        $totalBookSold = clone $transactionsDetail;
        $totalBookSold = $totalBookSold->sum('total_books');

        $users = User::latest();

        return view('dashboard.index', [
            'title' => 'Admin Dashboard',
            'monitor' => $monitorStok->get(),
            'totalBooks' => $totalBooks,
            'totalBookItems' => $totalBookItems,
            'totalBooksIn' => $totalBooksIn,
            'totalBookSold' => $totalBookSold,
            'totalTransactions' => $totalTransactions,
            'totalIncomes' => $totalIncomes,
            'users' => $users->paginate(),
        ]);
    }

    public function welcome()
    {
        $books = Book::latest();
        $monitorStok = $books->where('stock', '<=', 5);
        return view('dashboard.welcome', [
            'title' => 'Welcome',
            'monitor' => $monitorStok->get(),
        ]);
    }
}
