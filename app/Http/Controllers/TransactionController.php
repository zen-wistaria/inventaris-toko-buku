<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('updateBy')->latest();
        if (request('search')) {
            $transactions = Transaction::where('code', 'like', '%' . request('search') . '%')
                ->orWhere('customer_name', 'like', '%' . request('search') . '%')
                ->latest();
        }
        $monitorStok = Book::where('stock', '<=', 5);

        return view('transactions.index', ['title' => 'Transactions', 'monitor' => $monitorStok->get(), 'transactions' => $transactions->paginate(8)]);
    }

    public function create()
    {
        $books = Book::latest();
        $monitorStok = clone $books;
        $monitorStok = $monitorStok->where('stock', '<=', 5);
        return view('transactions.create', ['title' => 'Buat Transaksi', 'monitor' => $monitorStok->get(), 'books' => $books->get()]);
    }

    public function store(Request $request)
    {
        $request['code'] = 'INV-' . rand(100000, 999999);
        $request['total_price'] = 0;
        // $request['updatedB'] = "admin";
        $request['updatedBy'] = auth()->user()->id;

        $request->validate([
            'customer_name' => 'required|string|max:100',
            'book_id.*' => 'required|exists:books,id',
            'total_books.*' => 'required|integer|min:1',
        ]);

        // Create a new Transaction
        $transaction = Transaction::create([
            'customer_name' => $request->customer_name,
            'code' => $request->code,
            'total_price' => 0,
            'status' => 1,
            'updatedBy' => $request->updatedBy,
        ]);

        // Validate stock of book
        foreach ($request->book_id as $index => $bookId) {
            $book = Book::findOrFail($bookId);
            $totalBooks = $request->total_books[$index];
            if ($totalBooks > $book->stock) {
                $transaction->delete();
                return redirect()->back()->withErrors('Buku ' . $book->title . ', Stok tidak mencukupi');
            }
        }

        // Create TransactionDetails and update stock
        $totalPrice = 0;
        foreach ($request->book_id as $index => $bookId) {
            $book = Book::findOrFail($bookId);
            $totalBooks = $request->total_books[$index];

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'book_id' => $bookId,
                'total_books' => $totalBooks,
                'total_price' => $book->price * $totalBooks,
            ]);

            // Update the stock
            $book->stock -= $totalBooks;
            $book->save();

            // Update total price
            $totalPrice += $book->price * $totalBooks;
        }
        Transaction::where('id', $transaction->id)->update(['total_price' => $totalPrice]);
        return redirect()->route('transactions.index')->with('message', 'Transaksi Berhasil di tambahkan');
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);
        $transaction = Transaction::findOrFail(request('id'));
        $transaction->update([
            'status' => request('status'),
        ]);
        return redirect()->route('transactions.index')->with('message', 'Transaksi ' . $transaction->code . ' Berhasil di update');
    }

    public function details($transactionsCode)
    {
        $transaction = Transaction::with('details', 'details.book')->where('code', $transactionsCode)->get()->first();
        return view('transactions.details', ['title' => 'Detail Transaksi', 'transaction' => $transaction]);
    }
}
