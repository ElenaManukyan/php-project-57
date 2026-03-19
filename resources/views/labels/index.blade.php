<x-app-layout>
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <div class="w-full">
                <h1 class="mb-6 text-3xl md:text-5xl font-bold text-gray-900 dark:text-gray-300">
                    {{ __('views.labels.index.header') }}
                </h1>

                @auth
                <div class="mb-6">
                    <a href="{{ route('labels.create') }}" 
                       class="inline-block w-full sm:w-auto text-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-all shadow-md active:scale-95">
                        {{ __('views.labels.index.create_button') }}
                    </a>
                </div>
                @endauth

                <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <table class="w-full text-left border-collapse text-gray-900 dark:text-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 border-b-2 border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="py-4 px-4 font-semibold text-sm uppercase tracking-wider">ID</th>
                                <th class="py-4 px-4 font-semibold text-sm uppercase tracking-wider">{{ __('views.labels.index.name') }}</th>
                                <th class="py-4 px-4 font-semibold text-sm uppercase tracking-wider">{{ __('views.labels.index.description') }}</th>
                                <th class="py-4 px-4 font-semibold text-sm uppercase tracking-wider whitespace-nowrap">{{ __('views.labels.index.created_at') }}</th>
                                @auth
                                    <th class="py-4 px-4 font-semibold text-sm uppercase tracking-wider">{{ __('views.labels.index.actions') }}</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($labels as $label)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="py-4 px-4">{{ $label->id }}</td>
                                <td class="py-4 px-4 font-medium">{{ $label->name }}</td>
                                <td class="py-4 px-4 min-w-[200px] max-w-xs truncate md:max-w-md md:whitespace-normal">
                                    {{ $label->description }}
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap text-sm">{{ $label->created_at->format('d.m.Y') }}</td>
                                @auth
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-4">
                                        <a class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium" href="{{ route('labels.edit', $label) }}">
                                            {{ __('views.labels.index.edit') }}
                                        </a>
                                        <form action="{{ route('labels.destroy', $label) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium" 
                                                    onclick="return confirm('{{ __('Вы уверены?') }}')">
                                                {{ __('views.labels.index.delete') }}
                                            </button>
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