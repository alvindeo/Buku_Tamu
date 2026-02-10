<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2 bg-primary-red border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-deep-maroon focus:bg-deep-maroon active:bg-deep-maroon focus:outline-none focus:ring-2 focus:ring-primary-red focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
