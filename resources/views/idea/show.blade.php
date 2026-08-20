<x-layout>
    <x-layout.section>

        <div class="max-w-4xl py-8 mx-auto">
            <div class="flex items-center justify-between">
                <a href="{{ route('idea.index') }}"
                    class="flex items-center gap-x-2 text-sm font-medium btn btn-outlined">
                    <x-icons.arrow-back />
                    Back to Ideas</a>

                <div class="flex items-center gap-x-3">
                    <button x-data @click="$dispatch('open-modal', 'edit-idea')" class="btn btn-outlined">
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
                @if ($idea->image_path)
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $idea->image_path) }}" class="w-full h-auto object-cover"
                            alt="">
                    </div>
                @endif
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

                @if ($idea->description)
                    <x-card class="">
                        <div class="cursor-pointer">
                            <p>{{ $idea->description }}</p>
                        </div>
                    </x-card>
                @endif

                {{-- steps --}}
                @if ($idea->steps->count())

                    <article>
                        <h3 class="text-xl font-bold">Steps</h3>
                        <div class="mt-3 space-y-2">
                            @foreach ($idea->steps as $step)
                                <x-card>
                                    <form method="POST" action="{{ route('step.update', $step) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center gap-x-4">
                                            <button type="submit" role="checkbox"
                                                class="size-5 flex items-center justify-center rounded-lg text-primary-foreground border border-primary {{ $step->completed ? 'bg-primary' : 'border border-primary' }}">&check;</button>
                                            <span
                                                class="{{ $step->completed ? 'line-through' : '' }}">{{ $step->description }}</span>
                                        </div>
                                    </form>
                                </x-card>
                            @endforeach
                        </div>
                    </article>
                @endif

                {{-- links --}}
                @if ($idea->links->count())
                    <article>
                        <h3 class="text-xl font-bold">Links</h3>

                        <div class="mt-3 space-y-2">
                            @foreach ($idea->links as $link)
                                <x-card :href="$link" target="_blank"
                                    class="text-primary flex items-center gap-x-2 font-medium">
                                    <x-icons.external />
                                    {{ $link }}
                                </x-card>
                            @endforeach
                        </div>
                    </article>
                @endif
            </div>
        </div>

    </x-layout.section>
    <x-idea.modal :idea="$idea" />
</x-layout>
