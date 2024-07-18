<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookItem;
use Illuminate\Http\Request;

class BookItemController extends Controller
{
    public function index()
    {
        $books = BookItem::with('book')->with('updateBy')->latest();
        if (request('search')) {
            $search = request('search');
            $books->whereHas('book', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        }

        $monitorStok = Book::where('stock', '<=', 5);

        return view('entry.index', ['title' => 'Barang Masuk', 'monitor' => $monitorStok->get(), 'books' => $books->paginate(8)]);
    }

    public function create()
    {
        $books = Book::latest();
        $monitorStock = clone $books;
        $monitorStok = $monitorStock->where('stock', '<=', 5);
        return view('entry.create', ['title' => 'Tambah Barang Masuk', 'monitor' => $monitorStok->get(), 'books' => $books->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => 'numeric|required',
            'total_books' => 'numeric|required',
            'date' => 'date|required',
        ]);
        $data['updatedBy'] = auth()->user()->id;
        BookItem::create($data);
        $book = Book::findOrFail($request->book_id);
        $book->stock += $request->total_books;
        $book->save();
        return redirect()->route('entry.index')->with('message', 'Stok Buku ' . $book->title . ' Berhasil di tambahkan');
    }
}
