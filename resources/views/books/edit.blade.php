@extends('_layouts.master')

@section('body')
<div class="container lg:w-[75%] my-8 mx-auto shadow-sm bg-white p-5 rounded-md">
    <div class="justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]">
        <div class="p-4 w-full max-h-full">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Buku
                    </h3>
                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('books.update', $book->slug) }}" method="post" id="formbook">
                        @method('PATCH')
                        @csrf
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
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
                                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                                <input type="text" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->year }}" />
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                                <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $book->price }}" required />
                            </div>
                        </div>
                        <div>
                            <label for="synopsis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sinopsis</label>
                            <textarea id="synopsis" name="synopsis" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tulis sinopsis buku disini..." form="formbook"> {{ $book->synopsis }} </textarea>
                        </div>
                        <div class="flex justify-end space-x-2 h-10">
                            <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="window.history.back()">
                                Kembali
                            </button>
                            <button type="submit" class="w-28 px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection