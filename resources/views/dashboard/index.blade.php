@extends('_layouts.master')

@section('body')
<h3 class="text-3xl font-medium text-gray-700"> Admin Dashboard </h3>

<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalBooks }}</h4>
                    <div class="text-gray-500">Jumlah Buku</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-opacity-75 rounded-full bg-rose-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalBookItems }}</h4>
                    <div class="text-gray-500">Jumlah Total Buku</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>

                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalBookSold }} Eksemplar</h4>
                    <div class="text-gray-500">Jumlah Buku Terjual</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalTransactions }}</h4>
                    <div class="text-gray-500">Jumlah Transaksi</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-green-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                    </svg>

                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalIncomes }}</h4>
                    <div class="text-gray-500">Jumlah Pendapatan</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-red-600 bg-opacity-75 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                    </svg>


                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $totalBooksIn }} Eksemplar</h4>
                    <div class="text-gray-500">Jumlah Barang Masuk</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-28">

</div>

@endsection
