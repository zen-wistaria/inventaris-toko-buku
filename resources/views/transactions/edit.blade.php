@extends('_layouts.master')

@section('body')
<div class="container lg:w-[75%] my-8 mx-auto shadow-sm bg-white p-5 rounded-md">
    <div class="justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)]">
        <div class="p-4 w-full max-h-full">
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Transaksi
                    </h3>

                </div>
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ route('transactions.update', $transaction->code) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div>
                            <table class="text-lef text-sm">
                                <tr>
                                    <td class="font-semibold">Pelanggan</td>
                                    <td class="px-2">:</td>
                                    <td class="italic">{{ $transaction->customer_name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Kode Transaksi</td>
                                    <td class="px-2">:</td>
                                    <td class="italic">{{ $transaction->code }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Tanggal</td>
                                    <td class="px-2">:</td>
                                    <td class="italic">{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Total</td>
                                    <td class="px-2">:</td>
                                    <td class="italic">{{ $transaction->formatPrice() }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select name="status" id="status" class="w-full rounded-md block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    <option value="0" {{ $transaction->status == 0 ? 'selected' : '' }}>Lunas</option>
                                    <option value="1" {{ $transaction->status == 1 ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="2" {{ $transaction->status == 2 ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
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