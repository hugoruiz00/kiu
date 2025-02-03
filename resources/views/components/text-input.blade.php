@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#FF5C00] focus:ring-[#FF5C00] rounded-md shadow-sm']) !!}>
