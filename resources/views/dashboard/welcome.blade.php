@extends('_layouts.master')

@section('body')
<div class="flex flex-row justify-center items-center w-full h-screen -mt-16">
    <div class="flex flex-col justify-center items-center">
        <div class="flex items-center flex-col">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-56 h-56 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="mx-2 text-2xl font-semibold text-gray-500">Inventaris</span>
            <span class="mx-2 text-2xl font-semibold text-gray-500">Toko Buku</span>
        </div>
        <p class="text-xl font-semibold text-gray-500 mt-12">Welcome
            <strong>
                @isset( auth()->user()->name )
                {{ auth()->user()->name }}
                @endisset
            </strong>
        </p>
    </div>

</div>
@endsection