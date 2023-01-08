<x-layout>
    <x-slot:title>
        Create Logbook
    </x-slot:title>
    <main class="columns is-centered px-4">
        <section class="section column is-one-third box mt-6">
            <h1 class="title has-text-weight-bold">Create Logbook</h1>
            <form action="/logbooks" method="post">
                @csrf
                <div class="field">
                    <label for="name" class="label">Logbook Name</label>
                    <input type="text" name="name" id="name" class="input" placeholder="Enter logbook name..."
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="has-text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field has-text-right">
                    <input class="button is-primary" type="submit" value="Create">
                    <a href="/logbooks" class="button is-dark">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</x-layout>
