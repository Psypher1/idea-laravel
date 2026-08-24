<x-layout>
    <x-layout.section>
        <x-layout.section-heading class="text-center" title="Laravel Idea" subtitle="Log your ideas, do some work" />

        <div class="mt-10 text-center">

            @auth
                <a href="/ideas" class="btn btn-outlined text-lg">Go to your ideas</a>
            @endauth
            @guest
                <a href="/auth/signup"
                    class="bg-primary  hover:bg-primary/90 font-medium py-3 px-6 rounded-xl text-primary-foreground text-xl">Get
                    Started</a>
            @endguest
        </div>

    </x-layout.section>
</x-layout>
