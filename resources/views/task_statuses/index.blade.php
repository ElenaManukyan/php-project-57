<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-5 text-5xl line-height-1 shadow-sm">Статусы</h1>

                @auth
                <div class="mb-4">
                    <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Создать статус
                    </a>
                </div>
                @endauth

                <table class="mt-4 w-full text-left border-collapse">
                    <thead class="border-b-2 border-solid border-black">
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Имя</th>
                            <th class="py-2">Дата создания</th>
                            @auth
                                <th class="py-2 text-right">Действия</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $status)
                        <tr class="border-b border-dashed border-gray-300">
                            <td class="py-2">{{ $status->id }}</td>
                            <td class="py-2">{{ $status->name }}</td>
                            <td class="py-2">{{ $status->created_at->format('d.m.Y') }}</td>
                            @auth
                            <td class="py-2 text-right">
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