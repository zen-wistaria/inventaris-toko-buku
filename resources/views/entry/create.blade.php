@extends('_layouts.master')

@section('body')
<div class="container lg:w-[75%] my-8 mx-auto shadow-sm bg-white p-5 rounded-md">
    <div class="justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]">
        <div class="p-4 w-full max-h-full">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Barang
                    </h3>

                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('entry.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="book_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Buku</label>
                            <select name="book_id" id="tittle" class="w-full rounded-md block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div>
                                <label for="total_books" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                                <input type="number" name="total_books" id="total_books" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                                <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
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