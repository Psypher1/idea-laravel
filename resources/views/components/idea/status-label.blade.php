@props(['status' => 'pending'])

@php
    $classes = 'px-2 py-1 font-mediumrounded-xl text-xs';

    if ($status === 'pending') {
        $classes .= '  bg-yellow-500/10 text-yellow-500 border border-yellow-500/20';
    }

    if ($status === 'in_progress') {
        $classes .= ' bg-blue-500/10 text-blue-500 border-blue-500/20';
    }

    if ($status === 'completed') {
        $classes .= ' bg-primary/10 text-primary border-primary/20';
    }
@endphp

<span {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</span>
