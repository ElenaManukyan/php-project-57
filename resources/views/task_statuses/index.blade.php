<x-app-layout>
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <div class="w-full">
                <h1 class="mb-6 text-3xl md:text-5xl font-bold text-gray-900 dark:text-gray-300">
                    {{ __('layouts.app.statuses') }}
                </h1>

                @auth
                <div class="mb-6">
                    <a href="{{ route('task_statuses.create') }}" 
                       class="inline-block w-full sm:w-auto text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-all shadow-md active:scale-95">
                        {{ __('views.statuses.index.create_button') }}
                    </a>
                </div>
                @endauth

                <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <table class="w-full text-left border-collapse text-gray-900 dark:text-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 border-b-2 border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="py-4 px-4 font-semibold">{{ __('views.statuses.index.id') }}</th>
                                <th class="py-4 px-4 font-semibold">{{ __('views.statuses.index.name') }}</th>
                                <th class="py-4 px-4 font-semibold whitespace-nowrap">{{ __('views.statuses.index.created_at') }}</th>
                                @auth
                                    <th class="py-4 px-4 font-semibold">{{ __('views.statuses.index.actions') }}</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($taskStatuses as $status)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="py-4 px-4">{{ $status->id }}</td>
                                <td class="py-4 px-4 font-medium">{{ $status->name }}</td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm">{{ $status->created_at->format('d.m.Y') }}</td>
                                @auth
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-4">
                                        <a class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium" href="{{ route('task_statuses.edit', $status) }}">
                                            {{ __('views.statuses.index.edit') }}
                                        </a>
                                        <form action="{{ route('task_statuses.destroy', $status) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('task_statuses.destroy', $status) }}" 
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium cursor-pointer"
                                            onclick="event.preventDefault(); if(confirm('{{ __('Вы уверены?') }}')) { this.closest('form').submit(); }">
                                                {{ __('views.statuses.index.delete') }}
                                            </a>
                                        </form>
                                    </div>
                                </td>
                                @endauth
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>