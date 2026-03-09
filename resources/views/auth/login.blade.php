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
            Менеджер задач
        </a>
    </h2>

    <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-600
                "
                for="email"
                :value="__('Email')"
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
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-600
                "
                for="password"
                :value="__('Пароль')"
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
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="
                        rounded
                        border-gray-300
                        text-blue-600
                        shadow-sm

                        focus:!outline-none
                        focus:!ring
                        focus:!border-blue-500
                        focus:!ring-blue-500
                        focus:!ring-opacity-25
                    "
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('Запомнить меня') }}
                </span>
            </label>
        </div>

        <div class="flex items-center !justify-end mt-4">
            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
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
                >
                    {{ __('Забыли пароль?') }}
                </a>
            @endif

            <x-primary-button class="
                inline-flex items-center
                bg-blue-500 hover:bg-blue-700
                text-white font-medium
                rounded
                box-content
                !w-[48px]
                !h-[24px]
                !py-2 !px-4
                !ml-3
            ">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>