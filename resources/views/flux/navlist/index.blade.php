@pure

@props([
    'variant' => null,
])

@php
    $classes = Flux::classes()
        ->add('bg-dark-card fixed top-0 right-0 left-0 z-50 flex items-center justify-between')
        ->add('p-4 shadow-lg transition-colors duration-300');
@endphp

<nav {{ $attributes->class($classes) }} data-flux-navlist>
    {{ $slot }}
</nav>
