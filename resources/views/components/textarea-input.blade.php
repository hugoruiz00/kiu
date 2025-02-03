@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-[#FF5C00] focus:ring-[#FF5C00]']) !!}>{{ $slot }}</textarea>
