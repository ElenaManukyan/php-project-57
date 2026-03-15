<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-2 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="grid col-span-full">
                <h1 class="mb-5 text-5xl line-height-1 shadow-sm text-gray-300">{{ __('views.tasks.create.header') }}</h1>

                <form method="POST" action="{{ route('tasks.store') }}" class="w-full max-w-md text-gray-300">
                    @csrf

                    <div class="flex flex-col space-y-1">
                        <!-- Имя -->
                        <div>
                            <label for="name">{{ __('views.statuses.index.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="rounded border border-gray-300 w-full p-3 text-black">
                            @error('name') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <!-- Описание -->
                        <div>
                            <label for="description">{{ __('views.tasks.create.description') }}</label>
                            <textarea name="description" id="description" rows="5"
                                      class="rounded border border-gray-300 w-full p-3 text-black">{{ old('description') }}</textarea>
                        </div>

                        <!-- Статус -->
                        <div>
                            <label for="status_id">{{ __('views.tasks.create.status') }}</label>
                            <select name="status_id" id="status_id" 
                                    class="rounded border border-gray-300 w-full p-3 text-black">
                                <option value=""></option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
                        </div>

                        <!-- Исполнитель -->
                        <div>
                            <label for="assigned_to_id">{{ __('views.tasks.index.filter_executor') }}</label>
                            <select name="assigned_to_id" id="assigned_to_id" 
                                    class="rounded border border-gray-300 w-full p-3 text-black">
                                <option value=""></option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Метки -->
                        <div>
                            <label for="marks">{{ __('views.tasks.create.labels') }}</label>
                            <select name="labels[]" id="marks" class="rounded border-gray-300 w-full h-32 text-black" multiple>
                                @foreach($labels as $label)
                                    <option value="{{ $label->id }}"
                                        @if(isset($task) && $task->labels->contains($label->id)) selected @endif
                                    >
                                        {{ $label->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                {{ __('views.statuses.create.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>