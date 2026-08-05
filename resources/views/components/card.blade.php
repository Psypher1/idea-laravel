@props(['is' => 'a'])
<{{ $is }} {{ $attributes(['class' => 'border border-border rounded-md bg-card block p-4']) }}>
    {{ $slot }}
    </{{ $is }}>
