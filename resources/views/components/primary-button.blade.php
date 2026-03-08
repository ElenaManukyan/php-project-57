<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold rounded transition-colors duration-150'
]) }}>
    {{ $slot }}
</button>
