<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl mx-auto px-6 py-12">

            <div class="flex items-center justify-between mb-8">
                <h1 class="text-4xl font-semibold">
                    {{ __('Просмотр задачи') }}: {{ $task->name }}
                </h1>

                <span class="text-2xl opacity-70">⚙️</span>
            </div>

            <div class="space-y-3 text-lg">
                <p><span class="font-semibold">{{ __('views.tasks.show.name') }}:</span> {{ $task->name }}</p>
                <p><span class="font-semibold">{{ __('views.tasks.show.status') }}:</span> {{ $task->status->name }}</p>
                <p><span class="font-semibold">{{ __('views.tasks.show.description') }}:</span> {{ $task->description ?? '—' }}</p>
                <!-- Метки -->
                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach($task->labels as $label)
                        <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ $label->name }}
                        </div>
                    @endforeach
                </div>
            </div>

            @if(auth()->id() === $task->created_by_id)
                <div class="mt-8">
                    <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white font-medium">
                        {{ __('Редактировать') }}
                    </a>
                </div>
            @endif

        </div>
    </section>
</x-app-layout>