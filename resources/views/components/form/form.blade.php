@props(['title', 'subtitle'])
<div class="flex justify-center min-h-[calc(100vh-4rem)] items-center">
    <div class="w-full max-w-md">
        <div class="text-center">
            <h1 class="text-2xl font-bold tracking-tight">{{ $title }}</h1>
            <p class="text-muted-foreground">{{ $subtitle }}</p>
        </div>
        {{ $slot }}
    </div>
</div>
