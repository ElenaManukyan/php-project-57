<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-8 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-8 text-5xl line-height-1 shadow-sm text-gray-300">{{ __('views.tasks.index.header') }}</h1>

                @auth
                <div class="mb-4">
                    <a href="{{ route('tasks.create') }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        {{ __('views.tasks.index.create_button') }}
                    </a>
                </div>
                @endauth

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
                                        {{ __('views.tasks.index.delete') }}
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