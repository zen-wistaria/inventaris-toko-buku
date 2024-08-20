@extends('_layouts.master')

@section('body')
<div class="container lg:w-[75%] my-8 mx-auto shadow-sm bg-white p-5 rounded-md">
    <div class="justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]">
        <div class="p-4 w-full max-h-full">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah User
                    </h3>

                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Minimal 8 karakter.." />
                            </div>
                            <div>
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hak Akses</label>
                                <select name="role" id="role" class="w-full rounded-md block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    <option value="" disabled selected>Pilih Hak Akses...</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Pengelola</option>
                                    <option value="2">Kasir</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 h-10">
                            <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="window.history.back()">
                                Kembali
                            </button>
                            <button type="submit" class="w-28 px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection