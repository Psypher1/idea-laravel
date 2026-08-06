<x-layout>
    <x-layout.section>

        <div class="max-w-4xl py-8 mx-auto">
            <div class="flex items-center justify-between">
                <a href="{{ route('idea.index') }}"
                    class="flex items-center gap-x-2 text-sm font-medium btn btn-outlined">
                    <x-icons.arrow-back />
                    Back to Ideas</a>

                <div class="flex items-center gap-x-3">
                    <button class="btn btn-outlined">
                        <x-icons.pencil />
                        Edit
                    </button>
                    <form action="{{ route('idea.destroy', $idea) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outlined text-red-500">Delete</button>
                    </form>

                </div>
            </div>

            <div class="mt-8 space-y-5">
                <h1 class=" text-3xl font-bold">{{ $idea->title }}</h1>
                <div class="mt-2 flex items-center gap-x-3 ">
                    {{-- <x-idea.status-label status="{{ $idea->status->value }}"> --}}
                    <x-idea.status-label :status="$idea->status->value">
                        {{ $idea->status->label() }}
                    </x-idea.status-label>

                    <div class="text-muted-foreground text-sm">
                        {{ $idea->created_at->diffForHumans() }}
                    </div>

                </div>

                <x-card class="">
                    <div class="cursor-pointer">
                        <p>{{ $idea->description }}</p>
                    </div>
                </x-card>

                <article>
                    <h3 class="text-xl font-bold">Links</h3>

                    @if ($idea->links->count())
                        <div class="mt-3 space-y-2">
                            @foreach ($idea->links as $link)
                                <x-card :href="$link" target="_blank"
                                    class="text-primary flex items-center gap-x-2 font-medium">
                                    <x-icons.external />
                                    {{ $link }}
                                </x-card>
                            @endforeach
                        </div>
                    @endif
                </article>
            </div>
        </div>
    </x-layout.section>
</x-layout>
