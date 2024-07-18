@extends('_layouts.master')

@section('body')
<h3 class="text-gray-700 text-3xl font-semibold">Daftar Barang Masuk</h3>
<div class="container my-5 shadow-sm bg-white p-5 rounded-md">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-white dark:bg-gray-900 flex justify-between">

            <form class="flex items-center w-1/3" method="get" action="{{ route('entry.index') }}">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                    </div>
                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600" placeholder="Cari Buku..." name="search" required />
                </div>
                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-indigo-600 rounded-lg border border-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>

            <a href="{{ route('entry.create') }}" class="px-3 py-2.5 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Tambah Barang
            </a>
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right shadow-inherit text-gray-500 dark:text-gray-400">
        <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="text-center p-2">
                    No
                </th>
                <th class="px-6 py-3">
                    Tanggal
                </th>
                <th class="px-6 py-3">
                    Judul Buku
                </th>
                <th class="px-6 py-3">
                    Barang Masuk
                </th>
                <th class="px-6 py-3">
                    Pengelola
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th class="text-center">
                    {{ $books->firstItem() + $loop->index }}
                </th>
                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $book->date->format('d-m-Y') }}
                </th>
                <td class="px-6 py-4">
                    {{ $book->book->title }}
                </td>
                <td class="px-6 py-4">
                    {{ $book->total_books }}
                </td>
                <td class="px-6 py-4">
                    {{ $book->updateBy->name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="m-2">
        {{ $books->onEachSide(1)->links() }}
    </div>
</div>
</div>
@endsection