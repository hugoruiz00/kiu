@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-block pt-3 pb-1 px-3 text-[#FF5C00] border-b-2 border-[#FF5C00] rounded-t-lg active'
            : 'inline-block pt-3 pb-1 px-3 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
