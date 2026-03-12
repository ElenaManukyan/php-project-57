<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <header class="fixed w-full z-50">
            <nav class="bg-white border-gray-200 py-5 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    
                    <a href="/" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                            Менеджер задач
                        </span>
                    </a>

                    @if (Route::has('login'))
                        <div class="flex items-center lg:order-2">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded ml-2 !w-[50px] !h-[24px]">
                                        Выход
                                    </a>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 transition">
                                    Вход
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 transition">
                                        Регистрация
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif

                    <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                        <ul class="flex flex-col mt-4 font-light lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    Задачи
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    Статусы
                                </a>
                            </li>
                            <li>
                                <a href="" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    Метки
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </header>
        <div class="min-h-screen bg-gray-100">      
            <main class="mx-auto w-full">
                <div class="relative">
                    @if (session('error') || session('success'))
                        <div 
                            x-data="{ show: true }" 
                            x-show="show"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2 max-h-0"
                            x-transition:enter-end="opacity-100 transform translate-y-0 max-h-40"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 max-h-40"
                            x-transition:leave-end="opacity-0 max-h-0"
                            class="relative" 
                        >
                            <div class="relative z-50 overflow-hidden top-50 p-4 mx-auto mt-2 mb-2 text-sm rounded-lg shadow-2xl w-fit {{ session('error') ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}" role="alert">
                                <span class="font-medium">
                                    {{ session('error') ?? session('success') }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="relative z-0">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
