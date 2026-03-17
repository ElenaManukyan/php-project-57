<x-app-layout>
    <section class="bg-white dark:bg-gray-900 text-gray-300">
        <div class="max-w-screen-xl mx-auto px-6 py-12">

            <div class="flex items-center justify-start mb-8">
                <h1 class="text-4xl font-semibold">
                    {{ __('views.tasks.index.show') }}: {{ $task->name }}
                </h1>

                @if(auth()->id() === $task->created_by_id)
                    <a href="{{ route('tasks.edit', $task) }}" 
                    title="{{ __('Редактировать') }}" 
                    class="text-4xl opacity-70 hover:opacity-100 transition-opacity ml-4">
                        ⚙️
                    </a>
                @else
                    <span class="text-4xl opacity-20" title="{{ __('views.tasks.index.rightsVerification') }}">⚙️</span>
                @endif
            </div>

            <div class="space-y-3 text-lg">
                <p><span class="font-semibold">{{ __('views.statuses.index.name') }}:</span> {{ $task->name }}</p>
                <p><span class="font-semibold">{{ __('views.tasks.create.status') }}:</span> {{ $task->status->name }}</p>
                <p><span class="font-semibold">{{ __('views.tasks.create.description') }}:</span> {{ $task->description ?? '—' }}</p>
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
        </div>
    </section>
</x-app-layout>