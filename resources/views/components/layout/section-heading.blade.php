@props(['title', 'subtitle'])
<header {{ $attributes }}>
    <h1 class="text-4xl font-bold">{{ $title }}</h1>
    <p class="text-muted-foreground text-xl mt-1">{{ $subtitle }}</p>
</header>
