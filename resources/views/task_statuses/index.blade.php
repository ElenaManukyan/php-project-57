<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-8 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-8 text-5xl line-height-1 shadow-sm text-gray-300">{{ __('layouts.app.statuses') }}</h1>

                @auth
                <div class="mb-4">
                    <a href="{{ route('task_statuses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                        {{ __('views.statuses.index.create_button') }}
                    </a>
                </div>
                @endauth

                <table class="mt-4 w-full text-left border-collapse text-gray-300">
                    <thead class="border-b-2 border-solid border-gray-300">
                        <tr>
                            <th class="py-2">{{ __('views.statuses.index.id') }}</th>
                            <th class="py-2">{{ __('views.statuses.index.name') }}</th>
                            <th class="py-2">{{ __('views.statuses.index.created_at') }}</th>
                            @auth
                                <th class="py-2">{{ __('views.statuses.index.actions') }}</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taskStatuses as $status)
                        <tr class="border-b border-dashed border-gray-300">
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->created_at->format('d.m.Y') }}</td>
                            @auth
                            <td>
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $status) }}">
                                    {{ __('views.statuses.index.edit') }}
                                </a>
                                <form action="{{ route('task_statuses.destroy', $status) }}" method="POST" class="inline ml-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Вы уверены?')">
                                        {{ __('views.statuses.index.delete') }}
                                    </button>
                                </form>
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