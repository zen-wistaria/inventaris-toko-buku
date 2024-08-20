<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">

    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body>


    <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
        <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
            <div class="flex justify-center items-center">
                <div class="flex items-center flex-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span class="mx-2 text-xl font-semibold text-gray-500">Inventaris</span>
                    <span class="mx-2 text-xl font-semibold text-gray-500">Toko Buku</span>
                </div>
            </div>

            <!-- message error input validation -->
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="inline-block">
                <div class="-mx-3 py-2 px-4">
                    <div class="mx-3">
                        <span class="text-red-500 font-semibold">Error</span>
                        <p class="text-red-600 text-sm">{{ $error }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            <!-- message Action -->
            <div class="m-2">
                @if (session('message'))
                <div class="inline-block">
                    <div class="-mx-3 py-2 px-4">
                        <div class="mx-3">
                            <span class="text-green-500 font-semibold">Sukses</span>
                            <p class="text-gray-600 text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <form class="mt-4" action="{{ route('login') }}" method="post">
                @csrf
                <label class="block" for="login">
                    <span class="text-gray-700 text-sm">Email / Username</span>
                    <input type="text" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600" id="login" name="login" autofocus required>
                </label>

                <label class="block mt-3" for="password">
                    <span class="text-gray-700 text-sm">Password</span>
                    <input type="password" class="form-input mt-1 block w-full rounded-md focus:border-indigo-600" id="password" name="password" required>
                </label>

                <!-- <div class="flex justify-between items-center mt-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-indigo-600">
                            <span class="mx-2 text-gray-600 text-sm">Remember me</span>
                        </label>
                    </div>

                    <div>
                        <a class="block text-sm fontme text-indigo-700 hover:underline" href="#">Forgot your password?</a>
                    </div>
                </div> -->

                <div class="mt-6">
                    <button class="py-2 px-4 text-center bg-indigo-600 rounded-md w-full text-white text-sm hover:bg-indigo-500">
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>