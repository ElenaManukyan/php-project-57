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

                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-left border-collapse text-gray-300 min-w-[800px]">
                        <thead class="bg-gray-50 dark:bg-gray-800 border-b-2 border-gray-300">
                            <tr>
                                <th class="py-3 px-4 tracking-wider text-sm font-bold">ID</th>
                                <th class="py-3 px-4 tracking-wider text-sm font-bold">{{ __('views.labels.index.name') }}</th>
                                <th class="py-3 px-4 tracking-wider text-sm font-bold">{{ __('views.labels.index.description') }}</th>
                                <th class="py-3 px-4 tracking-wider text-sm font-bold whitespace-nowrap">{{ __('views.labels.index.created_at') }}</th>
                                @auth
                                    <th class="py-3 px-4 tracking-wider text-sm font-bold">{{ __('views.labels.index.actions') }}</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($labels as $label)
                            <tr class="border-b border-dashed border-gray-700 hover:bg-gray-800 transition">
                                <td class="py-3 px-4">{{ $label->id }}</td>
                                <td class="py-3 px-4">{{ $label->name }}</td>
                                <td class="py-3 px-4 max-w-xs truncate md:whitespace-normal">
                                    {{ $label->description }}
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">{{ $label->created_at->format('d.m.Y') }}</td>
                                @auth
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('labels.edit', $label) }}">
                                            {{ __('views.labels.index.edit') }}
                                        </a>
                                        <form action="{{ route('labels.destroy', $label) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('labels.destroy', $label) }}" 
                                            class="text-red-600 hover:text-red-900 cursor-pointer"
                                            onclick="event.preventDefault(); if(confirm('{{ __('Вы уверены?') }}')) { this.closest('form').submit(); }">
                                                {{ __('views.labels.index.delete') }}
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