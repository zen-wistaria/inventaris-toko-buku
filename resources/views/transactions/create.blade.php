@extends('_layouts.master')

@section('body')
<!-- <h3 class="text-gray-700 text-3xl font-semibold">Tambah Barang Masuk</h3> -->
<div class="container lg:w-[75%] my-8 mx-auto shadow-sm bg-white p-5 rounded-md">
    <div class="justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]">
        <div class="p-4 w-full max-h-full">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Buat Transaksi
                    </h3>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('transactions.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="customer_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelanggan</label>
                            <input type="text" name="customer_name" id="customer_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div id="book-details">
                            <div class="book-detail grid gap-4 mb-4 grid-cols-2">
                                <div>
                                    <label for="book_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Buku</label>
                                    <select name="book_id[]" id="book_id" class="w-full rounded-md block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        <option value="" disabled selected>Pilih Buku ..</option>
                                        @foreach ($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }} | {{ $book->formatPrice() }} | Stok: {{ $book->stock }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                                    <input type="number" name="total_books[]" id="total_books" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-book" class="w-30 h-10 px-3 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Buku</button>
                        <div class="flex justify-end space-x-2 h-10">
                            <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="window.history.back()">
                                Kembali
                            </button>
                            <button type="submit" class="w-28 px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buat Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection