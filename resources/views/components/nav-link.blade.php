@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2 py-2 border-2 border-white rounded text-sm font-medium leading-5 text-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-2 py-2 border-2 border-white rounded text-sm font-medium leading-5 text-white hover:text-gray-200 hover:border-gray-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
