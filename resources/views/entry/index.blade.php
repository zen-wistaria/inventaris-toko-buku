@extends('_layouts.master')

@section('body')
<h3 class="text-3xl font-semibold text-gray-700">Daftar Barang Masuk</h3>
<div class="flex justify-between mt-8 mb-3">
    <form class="flex items-center w-1/3" method="get" action="{{ route('entry.index') }}">
        <div class="relative w-full">
            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </div>
            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600" placeholder="Cari Disini..." name="search" value="{{ request()->get('search') }}" />
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-indigo-600 rounded-lg border border-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>
    <a href="{{ route('entry.create') }}" class="px-3 py-2.5 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Tambah Barang
    </a>
</div>

<div class="flex flex-col">
    <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full">
                <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            No
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Judul Buku
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Barang Masuk
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            Ditambahkan Oleh
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($books as $book)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $books->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $book->date->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $book->book->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $book->total_books }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            {{ $book->updateBy->name }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-2">
    {{ $books->appends(['search' => $search])->onEachSide(1)->links() }}
</div>
@endsection