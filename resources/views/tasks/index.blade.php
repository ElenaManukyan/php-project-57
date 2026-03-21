<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:py-8">
            <div class="w-full">

                <h1 class="mb-8 text-4xl md:text-5xl line-height-1 shadow-sm text-gray-300">
                    {{ __('views.tasks.index.header') }}
                </h1>

                <div class="mb-6">
                    <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-col gap-3 lg:flex-row lg:items-center">
                        <div class="flex flex-col gap-3 sm:flex-row w-full lg:w-auto">
                            <select class="rounded border-gray-300 text-gray-700 w-full lg:w-48" name="filter[status_id]">
                                <option value="">{{ __('views.tasks.filter.status') }}</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ request()->input('filter.status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select class="rounded border-gray-300 text-gray-700 w-full lg:w-64" name="filter[created_by_id]">
                                <option value="">{{ __('views.tasks.filter.author') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request()->input('filter.created_by_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select class="rounded border-gray-300 text-gray-700 w-full lg:w-64" name="filter[assigned_to_id]">
                                <option value="">{{ __('views.tasks.filter.executor') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request()->input('filter.assigned_to_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition w-full lg:w-auto" type="submit">
                                {{ __('views.tasks.filter.apply') }}
                            </button>

                            @auth
                                <a href="{{ route('tasks.create') }}" 
                                   class="lg:hidden bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded whitespace-nowrap text-center w-full">
                                    {{ __('views.tasks.index.create_button') }}
                                </a>
                            @endauth
                        </div>

                        @auth
                            <div class="hidden lg:block ml-auto">
                                <a href="{{ route('tasks.create') }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded whitespace-nowrap transition">
                                    {{ __('views.tasks.index.create_button') }}
                                </a>
                            </div>
                        @endauth
                    </form>
                </div>

                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-left border-collapse text-gray-300 min-w-[800px]">
                        <thead class="bg-gray-50 dark:bg-gray-800 border-b-2 border-gray-300">
                            <tr>
                                <th class="py-3 px-4">{{ __('views.statuses.index.id') }}</th>
                                <th class="py-3 px-4">{{ __('views.tasks.create.status') }}</th>
                                <th class="py-3 px-4">{{ __('views.statuses.index.name') }}</th>
                                <th class="py-3 px-4">{{ __('views.tasks.index.filter_author') }}</th>
                                <th class="py-3 px-4">{{ __('views.tasks.create.executor') }}</th>
                                <th class="py-3 px-4">{{ __('views.statuses.index.created_at') }}</th>
                                @auth
                                    <th class="py-3 px-4">{{ __('views.statuses.index.actions') }}</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr class="border-b border-dashed border-gray-700 hover:bg-gray-800 transition">
                                <td class="py-3 px-4">{{ $task->id }}</td>
                                <td class="py-3 px-4">{{ $task->status->name }}</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-blue-400 hover:text-blue-600 font-medium">
                                        {{ $task->name }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">{{ $task->author->name }}</td>
                                <td class="py-3 px-4">{{ $task->assignedTo->name ?? '—' }}</td>
                                <td class="py-3 px-4">{{ $task->created_at->format('d.m.Y') }}</td>
                                @auth
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        @if(auth()->id() === $task->created_by_id)
                                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                                {{ __('views.statuses.index.edit') }}
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" id="delete-task-{{ $task->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('tasks.destroy', $task) }}" 
                                                class="text-red-600 hover:text-red-900 cursor-pointer"
                                                onclick="event.preventDefault(); if(confirm('{{ __('views.tasks.index.confirm_delete') }}')) { this.closest('form').submit(); }">
                                                    {{ __('views.statuses.index.delete') }}
                                                </a>
                                            </form>
                                        @endif
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