<x-app-layout>
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16">
            <div class="w-full">
                <h1 class="mb-8 text-3xl md:text-5xl font-bold text-gray-900 dark:text-gray-300">
                    {{ __('views.labels.index.create_button') }}
                </h1>

                <form method="POST" action="{{ route('labels.store') }}" class="w-full lg:max-w-md text-gray-900 dark:text-gray-300">
                    @csrf
                    <div class="flex flex-col space-y-4">
                        
                        <div class="flex flex-col gap-2">
                            <label for="name" class="font-medium">
                                {{ __('views.labels.index.name') }}
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="rounded-md border border-gray-300 w-full p-3 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm">
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="description" class="font-medium">
                                {{ __('views.labels.index.description') }}
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      class="rounded-md border border-gray-300 w-full p-3 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-all active:scale-95 shadow-md">
                                {{ __('views.statuses.create.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>