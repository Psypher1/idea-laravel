<x-layout>
    <x-layout.section>

        <header>
            <h1 class="text-2xl font-bold">Ideas</h1>
            <p class="text-muted-foreground mt-1">Capture your thoughts. Make a plan</p>

            <x-card x-data @click="$dispatch('open-modal', 'create-idea')" is="button" type="button"
                class="mt-5 cursor-pointer w-full">
                What's the idea?
            </x-card>
        </header>

        <div class="mt-10">
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }} ">All</a>
            @foreach (App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}">{{ $status->label() }}
                    <span class="text-xs pl-2">{{ $statusCounts->get($status->value) }}</span>
                </a>
            @endforeach
        </div>

        <div class="mt-5 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">

                @forelse ($ideas as $idea)
                    {{-- href="{{ $idea->path() }}">  - method in Idea model --}}
                    {{-- href="/ideas/{{ $idea->id  }}"> --}}
                    <x-card href="{{ route('idea.show', $idea) }}">
                        <h3 class="text-lg text-foreground font-semibold">{{ $idea->title }}</h3>
                        <x-idea.status-label
                            status="{{ $idea->status }}">{{ $idea->status->label() }}</x-idea.status-label>
                        <p class="mt-4 line-clamp-3 text-muted-foreground">{{ $idea->description }}</p>
                        {{-- <small class="mt-2">{{ $idea->status }}</small> --}}
                        <small class="mt-3">{{ $idea->created_at->diffForHumans() }}</small>
                    </x-card>
                @empty
                    <x-card>
                        <p>No ideas to show</p>
                    </x-card>
                @endforelse
            </div>
        </div>

        {{-- modal --}}
        <x-modal name="create-idea" title="New Idea">
            <p>sexy inside stuff</p>
        </x-modal>
    </x-layout.section>
</x-layout>
