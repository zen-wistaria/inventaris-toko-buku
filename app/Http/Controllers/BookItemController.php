<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookItemRequest;
use App\Models\Book;
use App\Models\BookItem;

class BookItemController extends Controller
{
    public function index()
    {
        $title = 'Inventaris Toko Buku » Barang Masuk';
        $books = BookItem::with('book')->with('updateBy')->latest();
        if (request('search')) {
            $search = request('search');
            $books->whereHas('book', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        } else {
            $search = null;
        }
        $books = $books->paginate(7);
        $monitor = Book::where('stock', '<=', 5);

        return view('entry.index', compact('title', 'books', 'monitor', 'search'));
    }

    public function create()
    {
        $title = 'Inventaris Toko Buku » Tambah Barang Masuk';
        $books = Book::orderBy('title', 'asc')->get();
        $monitor = Book::where('stock', '<=', 5)->get();

        return view('entry.create', compact('title', 'books', 'monitor'));
    }

    public function store(BookItemRequest $request)
    {
        $data = $request->only(['book_id', 'total_books', 'date']);
        $data['updated_by'] = auth()->user()->id;
        BookItem::create($data);
        $book = Book::findOrFail($request->book_id);
        $book->stock += $request->total_books;
        $book->save();
        return to_route('entry.index')->with('message', 'Stok Buku ' . $book->title . ' Berhasil di tambahkan');
    }
}
