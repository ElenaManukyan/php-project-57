<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-5 text-5xl line-height-1 shadow-sm text-gray-300">{{ $task->name }}</h1>

                <div class="bg-gray-800 p-6 rounded text-gray-300 space-y-4">
                    <p><strong>{{ __('views.tasks.show.description') }}:</strong> {{ $task->description ?? '—' }}</p>
                    <p><strong>{{ __('views.tasks.show.status') }}:</strong> {{ $task->status->name }}</p>
                    <p><strong>{{ __('views.tasks.show.author') }}:</strong> {{ $task->author->name }}</p>
                    <p><strong>{{ __('views.tasks.show.assignee') }}:</strong> {{ $task->assignee?->name ?? '—' }}</p>
                    <p><strong>{{ __('views.tasks.show.created_at') }}:</strong> {{ $task->created_at->format('d.m.Y') }}</p>
                </div>

                @if(auth()->id() === $task->created_by_id)
                <div class="mt-6">
                    <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        {{ __('views.tasks.index.edit') }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>