@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-tan focus:border-primary-red focus:ring-primary-red rounded-xl shadow-sm']) }}>
