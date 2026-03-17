<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-5 text-5xl text-gray-300">{{ __('views.labels.index.create_button') }}</h1>

                <form method="POST" action="{{ route('labels.store') }}" class="w-full max-w-sm text-gray-300">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name">{{ __('views.labels.index.name') }}</label>
                        <input class="rounded border border-gray-300 w-full p-2 mt-2 text-black" type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror

                        <label for="description" class="mt-4">{{ __('views.labels.index.description') }}</label>
                        <textarea class="rounded border border-gray-300 w-full p-2 mt-2 text-black" name="description" id="description">{{ old('description') }}</textarea>
                        @error('description') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror

                        <div class="mt-5">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                {{ __('views.statuses.create.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>