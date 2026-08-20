@props(['idea' => new \App\Models\Idea()])

<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Edit Idea' : 'New Idea' }}">
    {{-- defaulting links ot array wasn't necessary for me --}}
    <form x-data="{ status: @js(old('status', $idea->status->value)), newLink: '', links: @js(old('links', $idea->links ?? [])), newStep: '', steps: @js(old('steps', $idea->steps->map(fn($step) => $step->description))) }" action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}"
        method="POST" enctype="multipart/form-data" class=" space-y-5">
        @csrf
        @if ($idea->exists)
            @method('PATCH')
        @endif
        {{-- title --}}
        <x-form.field name="title" label="Title" placeholder="Enter title for your idea" autofocus required
            :value="$idea->title" />

        {{-- status --}}
        <div class="space-y-2">
            <label for="status" class="label">Status</label>
            <div class="flex gap-x-3">
                @foreach (App\IdeaStatus::cases() as $status)
                    <button type="button" @click="status = @js($status->value)" class="btn  h-10 flex-1"
                        {{-- :class="status === @js($status->value) ? '' : 'btn-outlined'" --}}
                        :class="{ 'btn-outlined': status !== @js($status->value) }">{{ $status->label() }}</button>
                @endforeach
                <input class="input" type="hidden" name="status" :value="status" />
            </div>
            <x-form.error name="status" />
        </div>

        {{-- description --}}
        <x-form.field type="textarea" name="description" label="Description" placeholder="Enter description"
            :value="$idea->description" />


        <div>
            <label class="label" for="image">Featured</label>
            @if ($idea->image_path)
                <div class="mt-2 rounded-lg">
                    <img src="{{ asset('storage/' . $idea->image_path) }}" class="w-full h-60 object-cover"
                        alt="">
                    <button form="delete-image-form" class=" w-full btn mt-1 btn-outlined">Remove Image</button>
                </div>
            @endif
            <input type="file" name="image" class="mt-3" />
            <x-form.error name="image" />
        </div>

        {{-- steops --}}
        <div>
            <fieldset class="space-y-3">
                <legend class="label">Actionable Steps</legend>

                <template x-for="(step, index) in steps" :key="step">
                    <div class="flex gap-x-2 items-center">
                        <input class="input" readonly name="steps[]" x-model="step" id="">
                        <button @click="steps.splice(index, 1)" type="button"
                            class="btn btn-outlined form-muted-icon text-red-500/50"
                            aria-label="remove link link button">
                            <x-icons.close class="" />
                        </button>
                    </div>
                </template>

                <div class="flex gap-x-2 items-center">
                    <input x-model="newStep" id="new-step" placeholder="What needs to be done?"
                        class="input focus:ring-1 ring-primary">
                    <button @click="steps.push(newStep.trim()); newStep = ''" type="button"
                        :disabled="newStep.trim().length === 0" class="btn btn-outlined  disabled:cursor-not-allowed"
                        aria-label="add new step button">
                        <x-icons.close class="rotate-45 form-muted-icon" />
                    </button>
                </div>

            </fieldset>
        </div>

        {{-- links --}}
        <div>
            <fieldset class="space-y-3">
                <legend class="label">Links</legend>

                <template x-for="(link, index) in links" :key="link">
                    <div class="flex gap-x-2 items-center">
                        <input class="input" readonly name="links[]" x-model="link" id="">
                        <button @click="links.splice(index, 1)" type="button"
                            class="btn btn-outlined form-muted-icon text-red-500/50"
                            aria-label="remove link link button">
                            <x-icons.close class="" />
                        </button>
                    </div>
                </template>

                <div class="flex gap-x-2 items-center">
                    <input x-model="newLink" type="url" name="" placeholder="https://exmaple.com"
                        autocomplete="url" class="input focus:ring-1 ring-primary" id="new-link">
                    <button @click="links.push(newLink.trim()); newLink = ''" type="button"
                        :disabled="newLink.trim().length === 0" class="btn btn-outlined  disabled:cursor-not-allowed"
                        aria-label="add new link button">
                        <x-icons.close class="rotate-45 form-muted-icon" />
                    </button>
                </div>
            </fieldset>
        </div>

        <div class="flex justify-end gap-x-5">
            <button type="button" @click="$dispatch('close-modal')" class="btn btn-outlined">Cancel</button>
            <button type="submit" class="btn ">{{ $idea->exists ? 'Update' : 'Create' }}</button>
        </div>
    </form>

    @if ($idea->image_path)
        <form method="POST" action="{{ route('idea.image.destroy', $idea) }}" id="delete-image-form">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>
