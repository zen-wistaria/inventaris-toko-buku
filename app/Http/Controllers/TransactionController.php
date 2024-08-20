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
        $title = "Inventaris Toko Buku » Daftar Transaksi";
        $transactions = Transaction::with('updatedBy')->latest();
        if (request('search')) {
            $search = request('search');
            $transactions = $transactions->where('code', 'like', '%' . $search . '%')
                ->orWhere('customer_name', 'like', '%' . $search . '%')
                ->orderBy('customer_name', 'asc');
        } else {
            $search = null;
        }
        $transactions = $transactions->paginate(7);
        $monitor = Book::where('stock', '<=', 5)->get();

        return view('transactions.index', compact('title', 'transactions', 'monitor', 'search'));
    }

    public function create()
    {
        $title = 'Inventaris Toko Buku » Buat Transaksi';
        $books = Book::orderBy('title', 'asc')->where('stock', '>', 0)->get();
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();

        return view('transactions.create', compact('title', 'books', 'monitor'));
    }

    public function store(Request $request)
    {
        $message = [
            'customer_name.required' => 'Nama Pelanggan harus di isi dan tidak boleh kosong.',
            'customer_name.max' => 'Nama Pelanggan tidak boleh lebih dari 100 karakter.',
            'book_id.*.required' => 'Buku harus di pilih dan tidak boleh kosong.',
            'total_books.*.required' => 'Jumlah buku harus di pilih dan tidak boleh kosong.',
        ];

        $request->validate([
            'customer_name' => 'required|string|max:100',
            'book_id.*' => 'required|exists:books,id',
            'total_books.*' => 'required|integer|min:1',
        ], $message);

        $request['code'] = 'INV-' . rand(100000, 999999);
        $request['total_price'] = 0;
        $request['updated_by'] = auth()->user()->id;

        // Validate of book id in array is must be unique
        if (count($request->book_id) != count(array_unique($request->book_id))) {
            return redirect()->back()->withErrors('Terdapat buku yang sama dalam transaksi.');
        }

        // Create a new Transaction
        $transaction = Transaction::create([
            'customer_name' => $request->customer_name,
            'code' => $request->code,
            'total_price' => 0,
            'status' => 1,
            'updated_by' => $request->updated_by,
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

        return to_route('transactions.index')->with('message', 'Transaksi Berhasil di buat');
    }

    public function edit(Transaction $transaction)
    {
        $title = 'Inventaris Toko Buku » Edit Transaksi ' . $transaction->code;
        $books = Book::orderBy('title', 'asc')->get();
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();
        return view('transactions.edit', compact('transaction', 'title', 'books', 'monitor'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $message = [
            'status.required' => 'Status harus di pilih dan tidak boleh kosong.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
        $request->validate([
            'status' => 'required|in:0,1,2',
        ], $message);
        $transaction->update([
            'status' => request('status'),
        ]);

        return to_route('transactions.index')->with('message', 'Transaksi ' . $transaction->code . ' Berhasil di perbarui');
    }

    public function show($transactionsCode)
    {
        $title = 'Inventaris Toko Buku » Detail Transaksi ' . $transactionsCode;
        $transaction = Transaction::where('code', $transactionsCode)->firstOrFail();
        $transactionDetails = $transaction->details()->with('book')->paginate(7);
        return view('transactions.details', compact('title', 'transaction', 'transactionDetails'));
    }
}
