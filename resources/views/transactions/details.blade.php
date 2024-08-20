@extends('_layouts.master')

@section('body')
<h3 class="text-3xl font-semibold text-gray-700"> Detail Transaksi {{ $transaction->code }} </h3>
<div class="container p-5 my-5 bg-white rounded-md shadow-sm">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="mt-2 mb-5 text-sm font-semibold">
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
            <div class="text-sm italic text-red-500">
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
            <div class="text-sm italic text-green-500">
                {{ session('message') }}
            </div>
            @endif
            @if (session('message') && session('status') == 'error')
            <div class="text-sm italic text-red-500">
                {{ session('message') }}
            </div>
            @endif

        </div>

        <!-- table -->
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right shadow-inherit dark:text-gray-400">
            <thead class="text-sm text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="p-2 text-center">
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
                @foreach ($transactionDetails as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th class="text-center">
                        {{ $transactionDetails->firstItem() + $loop->index }}
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
                    <th colspan="4" class="px-6 py-4 text-sm font-semibold text-gray-900 uppercase whitespace-nowrap dark:text-white">
                        Total : {{ $transaction->formatPrice() }}
                        </td>
                </tr>
            </tbody>
        </table>

        <!-- pagination -->
        <div class="m-2">
            {{ $transactionDetails->onEachSide(1)->links() }}
        </div>
    </div>
</div>

@endsection
