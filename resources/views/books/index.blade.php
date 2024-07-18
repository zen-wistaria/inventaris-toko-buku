@extends('_layouts.master')

@section('body')
<h3 class="text-gray-700 text-3xl font-semibold">Daftar Buku</h3>
<div class="container my-5 shadow-sm bg-white p-5 rounded-md">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <div class="p-4 bg-white dark:bg-gray-900 flex justify-between">
            <form class="flex items-center w-1/3" method="get" action="{{ route('books.index') }}">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                    </div>
                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-600 dark:focus:border-indigo-600" placeholder="Cari Disini..." name="search" required />
                </div>
                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-indigo-600 rounded-lg border border-indigo-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
            <!-- Modal toggle Tambah Buku -->
            <button data-modal-target="form-input-buku" data-modal-toggle="form-input-buku" class="px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                Tambah Buku
            </button>
        </div>

        <!-- table -->
        <table class="w-full text-sm text-left rtl:text-right shadow-inherit text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="text-center p-2">No</th>
                    <th class="px-6 py-3">
                        Judul
                    </th>
                    <th class="px-6 py-3">
                        Penulis
                    </th>
                    <th class="px-6 py-3">
                        Penerbit
                    </th>
                    <th class="px-6 py-3">
                        Harga
                    </th>
                    <th class="px-6 py-3">
                        Tahun Rilis
                    </th>
                    <th class="px-6 py-3">
                        Stok
                    </th>
                    <th class="px-6 py-3">
                        Pengelola
                    </th>
                    <th class="px-6 py-3 text-center">
                        Action
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
                        {{ $book->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $book->author }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->publisher }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->formatPrice() }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->year }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->stock }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->updateBy->name }}
                    </td>
                    <td class="px-6 py-4">
                        <button type="button" class=" w-20 p-1.5 bg-yellow-500 rounded-md font-medium text-white dark:text-blue-500 hover:bg-yellow-400 inline mb-1" data-modal-target="form-edit-buku{{ $book->id }}" data-modal-toggle="form-edit-buku{{ $book->id }}" id="btn-edit-buku">
                            Edit
                        </button>
                        <!-- Modal Edit Buku -->
                        <div id="form-edit-buku{{ $book->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Edit Buku
                                        </h3>

                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <form class="space-y-4" action="{{ route('books.update') }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <div class="form-edit-buku{{ $book->id }}">
                                                <div>
                                                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                                                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->title }}" required />
                                                </div>
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div>
                                                        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                                                        <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->author }}" required />
                                                    </div>
                                                    <div>
                                                        <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                                                        <input type="text" name="publisher" id="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->publisher }}" required />
                                                    </div>
                                                    <div>
                                                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                                        <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->price }}" required />
                                                    </div>
                                                    <div>
                                                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Rilis</label>
                                                        <input type="text" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->year }}" required />
                                                    </div>
                                                    <input type="hidden" name="id" value="{{ $book->id }}">
                                                </div>
                                            </div>
                                            <div class="flex justify-end space-x-2 h-10">
                                                <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="form-edit-buku{{ $book->id }}">
                                                    Batal
                                                </button>
                                                <button type="submit" class="w-28 px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Perbarui
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-modal-target="deleteModal{{ $book->id }}" data-modal-toggle="deleteModal{{ $book->id }}" class="w-20 p-1.5 bg-red-700 rounded-md font-medium text-white dark:text-blue-500 hover:bg-red-600 inline" id="btn-delete-buku">
                            Delete
                        </button>
                        <!-- Modal Delete Confirm-->
                        <div id="deleteModal{{ $book->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                    <form action="{{ route('books.destroy', $book->slug) }}" method="post" class="inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteModal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="mb-4 text-gray-500 dark:text-gray-300">Hapus buku <strong>{{ $book->title }}</strong> ?</p>
                                        <div class="flex justify-center space-x-2 h-10">
                                            <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-toggle="deleteModal{{ $book->id }}">
                                                Batal
                                            </button>
                                            <button type="submit" class="w-28 px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- pagination -->
        <div class="m-2">
            {{ $books->links() }}
        </div>
    </div>

    <!-- Modal Tambah Buku -->
    <div id="form-input-buku" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Tambah Buku
                    </h3>

                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('books.store') }}" method="post">
                        @csrf
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div>
                                <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penulis</label>
                                <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penerbit</label>
                                <input type="text" name="publisher" id="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun Rilis</label>
                                <input type="text" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                        </div>
                        <div class="flex justify-end space-x-2 h-10">
                            <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="form-input-buku">
                                Batal
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