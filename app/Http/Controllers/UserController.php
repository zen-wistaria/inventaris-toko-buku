<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Inventaris Toko Buku » Daftar Pengguna';
        $users = User::orderBy('name', 'asc');
        if (request('search')) {
            $search = request('search');
            $users = $users->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orderBy('name', 'asc');
        } else {
            $search = null;
        }
        $users = $users->paginate(7);
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();

        return view('users.index', compact('title', 'users', 'monitor', 'search'));
    }
    public function create()
    {
        $title = 'Inventaris Toko Buku » Tambah Pengguna';
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();
        return view('users.create', compact('title', 'monitor'));
    }
    public function store(UserRequest $request)
    {
        $data = $request->only('name', 'email', 'address', 'role', 'password');
        $nameParts = explode(' ', $data['name']);
        $data['username'] = strtolower($nameParts[0]);
        User::create($data);
        return redirect()->route('users.index')->with('message', 'Pengguna ' . $data['name'] . ' Berhasil di tambahkan');
    }

    public function edit(User $user)
    {
        $title = 'Inventaris Toko Buku » Edit Pengguna';
        $monitor = Book::where('stock', '<=', 5)->orderBy('stock', 'asc')->get();
        return view('users.edit', compact('user', 'title', 'monitor'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->only('name', 'email', 'address', 'role');
        if ($request->password != null) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('message', $user->name . ' berhasil di perbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', $user->name . ' Berhasil di hapus');
    }
}
