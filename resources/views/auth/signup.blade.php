<x-layout>

    <x-form title="Signup for an account" subtitle="Start tracking your ideas today">
        <form action="/signup" method="POST" class="mt-5 space-y-4">
            @csrf
            <x-form.field name="name" label="Name" />
            <x-form.field name="email" label="Email" type="email" />
            <x-form.field name="password" label="Password" type="password" />


            <button type="submit" class="btn h-10 w-full">Sign Up</button>
        </form>
    </x-form>

</x-layout>
