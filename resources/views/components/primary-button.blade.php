<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-3 bg-blue-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-blue-700 hover:shadow-md focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 w-full']) }}>
    {{ $slot }}
</button>
