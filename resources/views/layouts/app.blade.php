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

        <header class="w-full">
            <nav class="bg-white border-gray-200 py-5 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    
                    <a href="/" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                            {{ __('layouts.app.name') }}
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
                                        {{ __('layouts.app.logout') }}
                                    </a>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 mr-2 transition">
                                    {{ __('layouts.app.login') }}
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 transition">
                                        {{ __('layouts.app.registration') }}
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif

                    <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                        <ul class="flex flex-col mt-4 font-normal text-gray-300 lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    {{ __('layouts.app.tasks') }}
                                </a>
                                <!-- <a href="" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    {{ __('layouts.app.tasks') }}
                                </a> -->
                            </li>
                            <li>
                                <a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    {{ __('layouts.app.statuses') }}
                                </a>
                            </li>
                            <li>
                                <a href="" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                                    {{ __('layouts.app.labels') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </nav>
        </header>
        <div class="bg-gray-100">      
            <main class="mx-auto w-full">
                <div class="relative">
                    <div class="dark:bg-gray-900">
                        @if (session()->has('flash_notification'))
                            @foreach (session('flash_notification') as $message)
                                <div 
                                    x-data="{ show: true }" 
                                    x-show="show"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 -mt-16"
                                    x-transition:enter-end="opacity-100 mt-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 mt-0"
                                    x-transition:leave-end="opacity-0 mt-0"
                                    class="ml-36 p-4 text-sm rounded-lg shadow-md flex items-center gap-3 w-fit {{ $message->level === 'danger' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}"
                                >
                                    <span>{{ $message->message }}</span>
                                    <button @click="show = false" class="text-lg leading-none opacity-50 hover:opacity-100">&times;</button>
                                </div>
                            @endforeach
                        @endif


                        {{ $slot }}
                    </div>
                </div>
                </div>
            </main>
        </div>
    </body>
</html>
