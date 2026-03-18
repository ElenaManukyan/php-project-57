<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-8 lg:grid-cols-12">
            <div class="grid col-span-full">

                <h1 class="mb-8 text-5xl line-height-1 shadow-sm text-gray-300">{{ __('views.tasks.index.header') }}</h1>

                <div class="flex flex-row gap-4 mb-2">
                    <div class="w-full">
                        <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap items-center">
                            <select class="rounded border-gray-300 text-gray-700" name="filter[status_id]">
                                <option value="">{{ __('views.tasks.filter.status') }}</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ request()->input('filter.status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select class="rounded border-gray-300 text-gray-700 w-80" name="filter[created_by_id]">
                                <option value="">{{ __('views.tasks.filter.author') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request()->input('filter.created_by_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select class="rounded border-gray-300 text-gray-700 w-80" name="filter[assigned_to_id]">
                                <option value="">{{ __('views.tasks.filter.executor') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request()->input('filter.assigned_to_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>

                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded ml-2" type="submit">
                                {{ __('views.tasks.filter.apply') }}
                            </button>

                            <!-- Кнопка создания  -->
                            @auth
                            <div class="ml-auto">
                                <a href="{{ route('tasks.create') }}" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded ml-2 whitespace-nowrap">
                                    {{ __('views.tasks.index.create_button') }}
                                </a>
                            </div>
                        @endauth
                        </form>
                    </div>
                </div>
                <table class="mt-4 w-full text-left border-collapse text-gray-300">
                    <thead class="border-b-2 border-solid border-gray-300">
                        <tr>
                            <th class="py-2">{{ __('views.statuses.index.id') }}</th>
                            <th class="py-2">{{ __('views.tasks.create.status') }}</th>
                            <th class="py-2">{{ __('views.statuses.index.name') }}</th>
                            <th class="py-2">{{ __('views.tasks.index.filter_author') }}</th>
                            <th class="py-2">{{ __('views.tasks.create.executor') }}</th>
                            <th class="py-2">{{ __('views.statuses.index.created_at') }}</th>
                            @auth
                                <th class="py-2">{{ __('views.statuses.index.actions') }}</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr class="border-b border-dashed border-gray-300">
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->status->name }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-400 hover:text-blue-600">
                                    {{ $task->name }}
                                </a>
                            </td>
                            <td>{{ $task->author->name }}</td>
                            <td>{{ $task->assignee?->name ?? '—' }}</td>
                            <td>{{ $task->created_at->format('d.m.Y') }}</td>
                            @auth
                            <td>
                                @if(auth()->id() === $task->created_by_id)
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task) }}">
                                    {{ __('views.statuses.index.edit') }}
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" 
                                            onclick="return confirm('{{ __('views.tasks.index.confirm_delete') }}')">
                                        {{ __('views.statuses.index.delete') }}
                                    </button>
                                </form>
                                @endif
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