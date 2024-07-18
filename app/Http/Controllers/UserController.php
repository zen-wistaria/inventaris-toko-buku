<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email:dns|max:100|unique:users,email',
            'role' => 'in:0,1,2',
            'password' => 'required|min:8|max:255',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return redirect()->back()->with('message', 'Pengguna ' . $data['name'] . ' Berhasil di tambahkan');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', 'Pengguna ' . $user->name . ' Berhasil di hapus');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email:dns|max:100|unique:users,email',
            'role' => 'in:0,1,2',
        ]);

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::find($request->id);
        $user->update($data);
        return redirect()->back()->with('message', 'Data' . $user->name . ' berhasil di perbarui');
    }
}
