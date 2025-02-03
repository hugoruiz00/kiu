@props(['status', 'message'])

@php
$typeClasses = match ($status) {
    'success' =>  'bg-green-600',
    'warning' =>  'bg-yellow-500', 
    'danger' =>  'bg-red-500',
    default => 'bg-green-600',
};
@endphp

@if ($status)
    <div
        x-data="{show: true}"
        x-show="show"
        x-on:click="show=false"
        {{ $attributes->merge(['class' => "text-white py-3 text-center max-w-sm rounded-lg cursor-pointer $typeClasses",]) }}>
        {{ $message }}
    </div>
@endif