<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('layouts.app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

        <header class="w-full" x-data="{ open: false }">
            <nav class="bg-white border-gray-200 py-5 dark:bg-gray-900 shadow-md">
                <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                    
                    <a href="/" class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                            {{ __('layouts.app.name') }}
                        </span>
                    </a>

                    <div class="flex items-center lg:order-2 gap-2">
                        @if (Route::has('login'))
                            <div class="flex items-center">
                                @auth
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" 
                                           onclick="event.preventDefault(); this.closest('form').submit();"
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition">
                                            {{ __('layouts.app.logout') }}
                                        </a>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-800 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800 font-medium rounded-lg text-sm px-3 py-2 lg:px-5 lg:py-2.5 transition">
                                        {{ __('layouts.app.login') }}
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="hidden sm:block bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 transition">
                                            {{ __('layouts.app.registration') }}
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif

                        <button @click="open = !open" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 transition">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" x-show="!open"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" x-show="open" x-cloak><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                    <div :class="{'block': open, 'hidden': !open}" class="items-center justify-between w-full lg:flex lg:w-auto lg:order-1 transition-all duration-300">
                        <ul class="flex flex-col mt-4 font-normal lg:flex-row lg:space-x-8 lg:mt-0">
                            <li>
                                <a href="{{ route('tasks.index') }}" class="block py-3 pl-3 pr-4 text-gray-700 dark:text-gray-300 hover:text-blue-700 lg:p-0 transition">
                                    {{ __('layouts.app.tasks') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('task_statuses.index') }}" class="block py-3 pl-3 pr-4 text-gray-700 dark:text-gray-300 hover:text-blue-700 lg:p-0 transition">
                                    {{ __('layouts.app.statuses') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('labels.index') }}" class="block py-3 pl-3 pr-4 text-gray-700 dark:text-gray-300 hover:text-blue-700 lg:p-0 transition">
                                    {{ __('layouts.app.labels') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="mx-auto w-full">
            <div class="max-w-screen-xl mx-auto px-4 mt-4">
                @if (session()->has('flash_notification'))
                    @foreach (session('flash_notification') as $message)
                        <div 
                            x-data="{ show: true }" 
                            x-show="show"
                            x-transition
                            class="mb-4 p-4 text-sm rounded-lg shadow-md flex items-center justify-between w-full md:w-fit gap-3 {{ $message->level === 'danger' ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}"
                        >
                            <span>{{ $message->message }}</span>
                            <button @click="show = false" class="text-xl leading-none opacity-50 hover:opacity-100">&times;</button>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="relative">
                <div class="dark:bg-gray-900">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
