<x-layout>
    <x-layout.section>

        <header>
            <h1 class="text-2xl font-bold">Ideas</h1>
            <p class="text-muted-foreground mt-1">Capture your thoughts. Make a plan</p>

            <x-card x-data @click="$dispatch('open-modal', 'create-idea')" is="button" type="button"
                class="mt-5 cursor-pointer  w-full">
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
            <form x-data="{ status: 'pending', newLink: '', links: [] }" action="{{ route('idea.store') }}" method="POST" class=" space-y-5">
                @csrf
                <x-form.field name="title" label="Title" placeholder="Enter title for your idea" autofocus
                    required />
                <div class="space-y-2">
                    <label for="status" class="label">Status</label>
                    <div class="flex gap-x-3">
                        @foreach (App\IdeaStatus::cases() as $status)
                            <button type="button" @click="status = @js($status->value)"
                                class="btn  h-10 flex-1" {{-- :class="status === @js($status->value) ? '' : 'btn-outlined'" --}}
                                :class="{ 'btn-outlined': status !== @js($status->value) }">{{ $status->label() }}</button>
                        @endforeach
                        <input class="input" type="hidden" name="status" :value="status" />
                    </div>
                    <x-form.error name="status" />
                </div>
                <x-form.field type="textarea" name="description" label="Description" placeholder="Enter description" />

                <div>
                    <fieldset class="space-y-3">
                        <legend class="label">Links</legend>

                        <template x-for="(link, index) in links" :key="link">
                            <div class="flex gap-x-2 items-center">
                                <input class="input" readonly name="links[]" x-model="link" id="">
                                <button @click="links.splice(index, 1)" type="button"
                                    class="btn btn-outlined form-muted-icon text-red-500"
                                    aria-label="remove link link button">
                                    <x-icons.close class="form-muted-icon" />
                                </button>
                            </div>
                        </template>

                        <div class="flex gap-x-2 items-center">
                            <input x-model="newLink" type="url" name="" placeholder="https://exmaple.com"
                                autocomplete="url" class="input focus:ring-1 ring-primary" id="new-link">
                            <button @click="links.push(newLink.trim()); newLink = ''" type="button"
                                :disabled="newLink.trim().length === 0"
                                class="btn btn-outlined text-muted-foreground disabled:cursor-not-allowed"
                                aria-label="add new link button">
                                <x-icons.close class="rotate-45" />
                            </button>
                        </div>
                    </fieldset>
                </div>
                <div class="flex justify-end gap-x-5">
                    <button type="button" @click="$dispatch('close-modal')" class="btn btn-outlined">Cancel</button>
                    <button type="submit" class="btn ">Create Idea</button>
                </div>
            </form>
        </x-modal>
    </x-layout.section>
</x-layout>

{{-- in this file, Jeffery created another dispach for closing the modal, i dont think that was necessary --}}
