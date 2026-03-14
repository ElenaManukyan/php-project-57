<x-guest-layout>
    <h2 class="text-center text-3xl font-bold">
        <a
            href="{{ route('home') }}"
            class="
                font-normal
                transition-colors
                no-underline
                text-inherit
            ">
            {{ __('layouts.app.name') }}
        </a>
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label
                for="name"
                value="{{ __('views.statuses.index.name') }}"
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-600
                "
            />
            <x-text-input
                id="name"
                class="
                    block w-full mt-1
                    rounded-md
                    border border-gray-300
                    shadow-sm
                    
                    focus:!outline-none
                    focus:!ring
                    focus:!ring-blue-500
                    focus:!ring-opacity-25
                    focus:!border-blue-300
                "
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label
                for="email"
                value="Email"
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-600
                "
            />
            <x-text-input
                id="email"
                class="
                    block w-full mt-1
                    rounded-md
                    border border-gray-300
                    shadow-sm
                    
                    focus:!outline-none
                    focus:!ring
                    focus:!ring-blue-500
                    focus:!ring-opacity-25
                    focus:!border-blue-300
                    
                "
                type="email" name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label
                for="password"
                value="Пароль"
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-600
                "
            />
            <x-text-input
                id="password" 
                class="
                    block w-full mt-1
                    rounded-md
                    border border-gray-300
                    shadow-sm
                    
                    focus:!outline-none
                    focus:!ring-blue-500
                    focus:!ring-opacity-25
                    focus:!ring
                    focus:!border-blue-300
                "
                type="password"
                name="password"
                required autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label
                for="password_confirmation"
                value="Подтверждение"
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-600
                "
            />
            <x-text-input 
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="
                    block w-full mt-1
                    rounded-md
                    border border-gray-300
                    shadow-sm
                    
                    focus:!outline-none
                    focus:!ring-blue-500
                    focus:!ring-opacity-25
                    focus:!ring
                    focus:!border-blue-300
                "
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center !justify-end mt-4">
            <a
                class="
                    underline
                    text-sm
                    text-gray-600
                    hover:text-gray-900
                    rounded-md
                    focus:!outline-none
                    focus:!ring-2
                    focus:!ring-offset-2
                    focus:!ring-indigo-500
                    mr-2
                "
                href="{{ route('login') }}"
            >
                Уже зарегистрированы?
            </a>

            <x-primary-button
                class="
                    inline-flex items-center
                    bg-blue-500 hover:bg-blue-700
                    text-white font-medium
                    rounded
                    box-content
                    !w-[144px]
                    !h-[24px]
                    !py-2 !px-4
                    !ml-4
                "
            >
                Зарегистрировать
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
