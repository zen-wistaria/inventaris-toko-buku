@extends('_layouts.master')

@section('body')
<h3 class="text-gray-700 text-3xl font-semibold">Detail Transaksi </h3>
<div class="container my-5 shadow-sm bg-white p-5 rounded-md">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="text-sm font-semibold mt-2 mb-5">
            <tr>
                <td>Nama Customer</td>
                <td class="px-2"> : </td>
                <td>{{ $transaction->customer_name }}</td>
            </tr>
            <tr>
                <td>Kode Transaksi</td>
                <td class="px-2"> : </td>
                <td>{{ $transaction->code }}</td>
            </tr>
        </table>

        <!-- message error input validation -->
        <div class="m-2">
            @if ($errors->any())
            <div class="text-sm text-red-500 italic">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- message Action -->
        <div class="m-2">

            @if (session('message') && session('status') == 'success')
            <div class="text-sm text-green-500 italic">
                {{ session('message') }}
            </div>
            @endif
            @if (session('message') && session('status') == 'error')
            <div class="text-sm text-red-500 italic">
                {{ session('message') }}
            </div>
            @endif

        </div>

        <!-- table -->
        <table class="w-full text-sm text-left rtl:text-right shadow-inherit text-gray-500 dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="text-center p-2">
                        No
                    </th>
                    <th class="px-6 py-3 text-center">
                        Tgl. Transaksi
                    </th>
                    <th class="px-6 py-3">
                        Buku
                    </th>
                    <th class="px-6 py-3">
                        Jumlah
                    </th>
                    <th class="px-6 py-3">
                        Harga
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction->details as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="text-center">
                        {{ 1 + $loop->index }}
                    </th>
                    <th class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->book->title }}
                    </th>
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->total_books }}
                    </th>
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->formatPrice() }}
                    </th>

                </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="uppercase px-6 py-4 text-sm font-semibold  text-gray-900 whitespace-nowrap dark:text-white">
                        Total : {{ $transaction->formatPrice() }}
                        </td>
                </tr>
            </tbody>
        </table>

        <!-- pagination -->
        <div class="m-2">

        </div>
    </div>


    <!-- Modal Delete Confirm-->
    <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <form action="{{ route('transactions.destroy', $item->id) }}" method="post" class="inline">
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
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Hapus buku ?</p>
                    <div class="flex justify-center space-x-2 h-10">
                        <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-toggle="deleteModal">
                            Batal
                        </button>
                        <button type="submit" class="w-28 px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection