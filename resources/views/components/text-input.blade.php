@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring focus:ring-blue-500/20 focus:bg-white rounded-xl shadow-sm transition-all duration-200']) }}>
