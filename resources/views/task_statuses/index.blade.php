<x-app-layout>
    <header class="fixed w-full">
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
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 lg:px-5 lg:py-2.5 transition">
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
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full pt-10">
                <h1 class="mb-8 text-5xl line-height-1 shadow-sm text-gray-300">Статусы</h1>

                @auth
                <div class="mb-4">
                    <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        Создать статус
                    </a>
                </div>
                @endauth

                <table class="mt-4 w-full text-left border-collapse text-gray-300">
                    <thead class="border-b-2 border-solid border-gray-300">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Имя</th>
                            <th class="py-2">Дата создания</th>
                            @auth
                                <th class="py-2">Действия</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $status)
                        <tr class="border-b border-dashed border-gray-300">
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at->format('d.m.Y') }}</td>
                            @auth
                            <td>
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">
                                    Изменить
                                </a>
                                <form action="{{ route('task_statuses.destroy', $status) }}" method="POST" class="inline ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Вы уверены?')">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                            @endauth
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>