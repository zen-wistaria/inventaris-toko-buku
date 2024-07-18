@extends('_layouts.master')

@section('body')
<h3 class="text-gray-700 text-3xl font-semibold">Daftar Transaksi</h3>
<div class="container my-5 shadow-sm bg-white p-5 rounded-md">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-white dark:bg-gray-900 flex justify-between">


            <form class="flex items-center w-1/3" method="get" action="{{ route('transactions.index') }}">
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

            <a href="{{ route('transactions.create') }}" class="px-3 py-2.5 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Buat Transaksi
            </a>
        </div>

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
                    <th class="px-6 py-3">
                        Nama Pelanggan
                    </th>
                    <th class="px-6 py-3">
                        Kode Transaksi
                    </th>
                    <th class="px-6 py-3">
                        Total Bayar
                    </th>
                    <th class="px-6 py-3">
                        Status
                    </th>
                    <th class="px-6 py-3">
                        Kasir
                    </th>
                    <th class="px-6 py-3">
                        Tgl. Transaksi
                    </th>
                    <th class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="text-center">
                        {{ $transactions->firstItem() + $loop->index }}
                    </th>
                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $transaction->customer_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $transaction->code }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->formatPrice() }}
                    </td>

                    <td class="px-6 py-4">
                        @if ($transaction->status == '0')
                        <span class="bg-green-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Lunas</span>
                        @elseif ($transaction->status == '1')
                        <span class="bg-yellow-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Belum Bayar</span>
                        @else ($transaction->status == '2')
                        <span class="bg-red-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Dibatalkan</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->updateBy->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('transactions.details', $transaction->code) }}" class=" w-20 p-1.5 bg-blue-500 rounded-md font-medium text-white dark:text-blue-500 hover:bg-blue-400 inline-block mb-1">
                            Detail
                        </a>
                        <button type="button" class=" w-20 p-1.5 bg-yellow-500 rounded-md font-medium text-white dark:text-blue-500 hover:bg-yellow-400 inline mb-1" data-modal-target="form-edit{{ $transaction->id }}" data-modal-toggle="form-edit{{ $transaction->id }}">
                            Edit
                        </button>
                        <!-- Modal Edit Buku -->
                        <div id="form-edit{{ $transaction->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Status Transaksi
                                        </h3>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-2">
                                        <form class="space-y-4" action="{{ route('transactions.update') }}" method="post">
                                            @method('PATCH')
                                            @csrf
                                            <div class="form-edit{{ $transaction->id }}">
                                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $transaction->code }}</label>
                                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                    <option value="" disabled selected>Pilih Status</option>
                                                    <option value="0">Lunas</option>
                                                    <option value="1">Belum Bayar</option>
                                                    <option value="2">Dibatalkan</option>
                                                </select>
                                                <input type="hidden" name="id" value="{{ $transaction->id }}">
                                            </div>
                                            <div class="flex justify-end space-x-2 h-10">
                                                <button type="button" class="w-28 px-3 py-1 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="form-edit{{ $transaction->id }}">
                                                    Batal
                                                </button>
                                                <button type="submit" class="w-28 px-3 py-1 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-500 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui</button>
                                            </div>
                                        </form>

                                    </div>
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
            {{ $transactions->links() }}
        </div>
    </div>
</div>

@endsection