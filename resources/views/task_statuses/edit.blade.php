<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-5 text-5xl line-height-1 shadow-sm">Изменение статуса</h1>

                <form method="POST" action="{{ route('task_statuses.update', $taskStatus) }}" class="w-full max-w-sm">
                    @csrf
                    @method('PATCH')
                    
                    <div class="flex flex-col">
                        <label for="name">Имя</label>
                        <input class="rounded border border-gray-300 w-full p-2 mt-2" type="text" name="name" id="name" value="{{ old('name', $taskStatus->name) }}">
                        
                        @error('name')
                            <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror

                        <div class="mt-5">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Обновить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>