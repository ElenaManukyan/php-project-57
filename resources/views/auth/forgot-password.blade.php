<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label
                for="email"
                :value="__('Email')"
                class="
                    !block
                    !text-sm
                    !font-normal
                    !text-gray-900
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
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button
                class="
                    inline-flex items-center
                    bg-blue-500 hover:bg-blue-700
                    text-white font-bold
                    rounded
                    box-content
                    !w-[134px]
                    !h-[24px]
                    !py-2 !px-4
                    !ml-3  
                "
            >
                {{ __('Сбросить пароль') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
