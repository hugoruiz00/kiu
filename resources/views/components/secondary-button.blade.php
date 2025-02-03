<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 border-2 bg-white border-[#FF5C00] rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
