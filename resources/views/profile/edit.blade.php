<x-layout>
    <h1 class="text-center text-2xl font-semibold mt-5">{{ $user->name }}</h1>
    <x-form title="Edit your account" subtitle="Need to make a tweak">
        <form action="/profile" method="POST" class="mt-5 space-y-4">
            @csrf
            @method('PATCH')
            <x-form.field name="name" label="Name" :value="$user->name" />
            <x-form.field name="email" label="Email" type="email" :value="$user->email" />
            <x-form.field name="password" label="New Password" type="password" />


            <button type="submit" class="btn h-10 w-full">Update Account</button>
        </form>
    </x-form>
</x-layout>
