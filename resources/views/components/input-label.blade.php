@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-deep-maroon']) }}>
    {{ $value ?? $slot }}
</label>
