<x-layout>

    <x-form title="Sign In" subtitle="Glad to have you back">
        <form action="/signin" method="POST" class="mt-5 space-y-4">
            @csrf

            <x-form.field name="email" label="Email" type="email" />
            <x-form.field name="password" label="Password" type="password" />


            <button type="submit" class="btn h-10 w-full">Sign In</button>
        </form>
    </x-form>

</x-layout>
