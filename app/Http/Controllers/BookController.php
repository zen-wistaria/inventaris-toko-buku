<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('updateBy')->latest();
        if (request('search')) {
            $search = request('search');
            $books = $books->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('publisher', 'like', '%' . $search . '%')
                    ->orWhere('year', 'like', '%' . $search . '%');
            });
        }
        $monitorStok = clone $books;
        $monitorStok = $monitorStok->where('stock', '<=', 5);
        $title = 'Books';
        return view('books.index', ['title' => $title, 'monitor' => $monitorStok->get(), 'books' => $books->paginate(20)]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:100|unique:books',
            'author' => 'required|max:100',
            'publisher' => 'required|max:100',
            'price' => 'required|numeric',
            'year' => 'required|numeric|digits:4',
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['updatedBy'] = auth()->user()->id;

        Book::create($data);
        return redirect()->back()->with('message', 'Buku ' . $data['title'] . ' berhasil di tambahkan');
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

    // public function edit()
    // {
    //     if (request('book')) {
    //         return response()->json(Book::where('slug', request('book'))->first());
    //     }
    // }


    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:100',
            'author' => 'required|max:100',
            'publisher' => 'required|max:100',
            'price' => 'required|numeric',
            'year' => 'required|numeric|digits:4',
        ]);
        $data['slug'] = Str::slug($data['title']);

        $book = Book::findOrFail($request->id);
        $book->update($data);
        return redirect()->back()->with('message', 'Buku ' . $book->title . ' Berhasil di perbarui');
    }
}
