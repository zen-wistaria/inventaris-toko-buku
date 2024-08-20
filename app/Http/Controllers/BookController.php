<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    public function index()
    {
        $title = 'Inventaris Toko Buku » Daftar Buku';
        $books = Book::with('updatedBy')->orderBy('title', 'asc');
        if (request('search')) {
            $search = request('search');
            $books = $books->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('publisher', 'like', '%' . $search . '%')
                    ->orWhere('year', 'like', '%' . $search . '%');
            });
        } else {
            $search = null;
        }
        $monitor = clone $books;
        $books = $books->paginate(7);
        $monitor = $monitor->where('stock', '<=', 5)->orderBy('stock', 'asc')->get();

        return view('books.index', compact('title', 'books', 'monitor', 'search'));
    }

    public function store(BookRequest $request)
    {
        $data = $request->only(
            'title',
            'author',
            'publisher',
            'price',
            'year',
            'synopsis'
        );
        $data['slug'] = Str::slug($data['title']);
        $data['updated_by'] = auth()->user()->id;
        Book::create($data);

        return redirect()->route('books.index')->with('message', 'Buku ' . $data['title'] . ' berhasil di tambahkan');
    }

    public function create()
    {
        $title = 'Inventaris Toko Buku » Tambah Buku';
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();
        return view('books.create', compact('title', 'monitor'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $data = $request->only(
            'title',
            'author',
            'publisher',
            'price',
            'year',
            'synopsis'
        );
        $data['slug'] = Str::slug($data['title']);
        $book->update($data);

        return redirect()->route('books.index')->with('message', 'Buku ' . $book->title . ' Berhasil di perbarui');
    }

    public function destroy(Book $book)
    {
        try {
            $result = Book::destroy($book->id);
        } catch (QueryException $err) {
            if ($err->getCode() == '23000') {
                return redirect()->back()->withErrors('Buku ' . $book->title . ' sudah pernah ada transaksi, tidak bisa di hapus');
            }
            return redirect()->back()->withErrors($err->getCode() . ' | ' . $err->getMessage());
        }

        if ($result) {
            return redirect()->back()->with('message', 'Buku ' . $book->title . ' berhasil di hapus');
        }
    }

    public function edit(Book $book)
    {
        $title = 'Inventaris Toko Buku » Edit Buku ' . $book->title;
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();
        return view('books.edit', compact('book', 'title', 'monitor'));
    }

    public function show(Book $book)
    {
        $title = 'Inventaris Toko Buku » Detail Buku ' . $book->title;
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();
        return view('books.show', compact('book', 'title', 'monitor'));
    }
}
