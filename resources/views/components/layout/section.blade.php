@props(['title' => '', 'subtitle' => ''])
<section class="py-6 md:py-12 ">
    <header class="">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        <p class="text-muted-foreground mt-1">{{ $subtitle }}</p>
    </header>
    {{ $slot }}
</section>
