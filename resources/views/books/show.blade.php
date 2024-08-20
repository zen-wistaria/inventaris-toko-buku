@extends('_layouts.master')

@section('body')
<div class="container lg:w-[75%] my-8 mx-auto shadow-sm bg-white p-5 rounded-md">
    <div class="justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]">
        <div class="p-4 w-full max-h-full">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Detail Buku <i>{{ $book->title }}</i>
                    </h3>

                </div>
                <div class="p-4 md:p-5">

                    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <table class="table-auto">
                            <tr>
                                <th class="px-6 text-lg text-left text-gray-700">Judul</th>
                                <td>:</td>
                                <td class="px-6 text-lg text-gray-700 italic">{{ $book->title }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 text-lg text-left text-gray-700">Penulis</th>
                                <td>:</td>
                                <td class="px-6 text-lg text-gray-700 italic">{{ $book->author }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 text-lg text-left text-gray-700">Penerbit</th>
                                <td>:</td>
                                <td class="px-6 text-lg text-gray-700 italic">{{ $book->publisher }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 text-lg text-left text-gray-700">Tahun Rilis</th>
                                <td>:</td>
                                <td class="px-6 text-lg text-gray-700 italic">{{ $book->year }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 text-lg text-left text-gray-700">Sinopsis</th>
                                <td>:</td>
                                <td class="px-6 text-lg text-gray-700 italic">{{ $book->synopsis }}</td>
                            </tr>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection