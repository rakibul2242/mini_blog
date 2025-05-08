@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-sm font-medium leading-5 text-gray-900 bg-gray-400 dark:text-gray-100 dark:bg-blue-700'
            : 'inline-flex items-center text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:dark:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
