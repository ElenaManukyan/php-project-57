<x-app-layout>
    <section class="bg-white dark:bg-gray-900 min-h-screen">
        <div class="max-w-screen-xl px-4 pt-6 pb-8 mx-auto lg:py-16">
            <div class="w-full">
                <h1 class="mb-6 text-3xl md:text-5xl font-bold text-gray-900 dark:text-gray-300">
                    {{ __('views.tasks.index.edit') }}
                </h1>

                <form method="POST" action="{{ route('tasks.update', $task) }}" class="w-full lg:max-w-2xl text-gray-900 dark:text-gray-300">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col space-y-6">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="font-medium">{{ __('views.statuses.index.name') }}</label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', $task->name) }}"
                                   class="rounded-md border border-gray-300 w-full p-3 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm">
                            @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="description" class="font-medium">{{ __('views.tasks.create.description') }}</label>
                            <textarea name="description" id="description" rows="5"
                                      class="rounded-md border border-gray-300 w-full p-3 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="status_id" class="font-medium">{{ __('views.tasks.create.status') }}</label>
                            <select name="status_id" id="status_id" 
                                    class="rounded-md border border-gray-300 w-full p-3 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm">
                                @foreach($statuses as $id => $name)
                                    <option value="{{ $id }}" @selected(old('status_id', $task->status_id) == $id)>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="assigned_to_id" class="font-medium">{{ __('views.tasks.create.executor') }}</label>
                            <select name="assigned_to_id" id="assigned_to_id" 
                                    class="rounded-md border border-gray-300 w-full p-3 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition shadow-sm">
                                <option value="">{{ __('views.tasks.create.choose_assignee') }}</option>
                                @foreach($users as $id => $name)
                                    <option value="{{ $id }}" @selected(old('assigned_to_id', $task->assigned_to_id) == $id)>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="marks" class="font-medium">{{ __('views.tasks.create.labels') }}</label>
                            <select name="labels[]" id="marks" class="rounded-md border-gray-300 w-full h-48 text-black p-2 focus:ring-2 focus:ring-blue-500 outline-none" multiple>
                                @foreach($labels as $id => $name)
                                    <option value="{{ $id }}"
                                        @selected(
                                            is_array(old('labels')) 
                                            ? in_array($id, old('labels')) 
                                            : $task->labels->contains($id)
                                        )>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg transition-all active:scale-95 shadow-lg">
                                {{ __('views.statuses.edit.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>