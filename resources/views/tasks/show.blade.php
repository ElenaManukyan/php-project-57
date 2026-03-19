<x-app-layout>
    <section class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 min-h-screen">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 py-8 md:py-12">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                <h1 class="text-3xl md:text-4xl font-bold leading-tight break-words">
                    {{ __('views.tasks.index.show') }}: {{ $task->name }}
                </h1>

                <div class="flex items-center">
                    @if(auth()->id() === $task->created_by_id)
                        <a href="{{ route('tasks.edit', $task) }}" 
                           title="{{ __('Редактировать') }}" 
                           class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-800 text-2xl opacity-70 hover:opacity-100 transition-all hover:scale-110 shadow-sm">
                            ⚙️
                        </a>
                    @else
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-gray-50 dark:bg-gray-800 opacity-20 cursor-not-allowed" 
                             title="{{ __('views.tasks.index.rightsVerification') }}">
                            ⚙️
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-4 sm:p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="space-y-4 text-base md:text-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-[150px_1fr] gap-1 sm:gap-4">
                        <span class="font-semibold text-gray-500 dark:text-gray-400">{{ __('views.statuses.index.name') }}:</span>
                        <span class="break-words">{{ $task->name }}</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-[150px_1fr] gap-1 sm:gap-4 border-t border-gray-100 dark:border-gray-700 pt-4 sm:pt-0 sm:border-none">
                        <span class="font-semibold text-gray-500 dark:text-gray-400">{{ __('views.tasks.create.status') }}:</span>
                        <span>{{ $task->status->name }}</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-[150px_1fr] gap-1 sm:gap-4 border-t border-gray-100 dark:border-gray-700 pt-4 sm:pt-0 sm:border-none">
                        <span class="font-semibold text-gray-500 dark:text-gray-400">{{ __('views.tasks.create.description') }}:</span>
                        <div class="prose dark:prose-invert max-w-none break-words">
                            {{ $task->description ?? '—' }}
                        </div>
                    </div>

                    @if($task->labels->isNotEmpty())
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <span class="block mb-3 font-semibold text-gray-500 dark:text-gray-400 text-sm uppercase tracking-wider">
                                {{ __('views.tasks.create.labels') }}
                            </span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($task->labels as $label)
                                    <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full border border-blue-200 dark:border-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ $label->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app-layout>