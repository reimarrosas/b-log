<x-layout>
    <x-slot:title>Register</x-slot:title>
    <main class="columns is-centered">
        <section class="section column is-one-third has-shadow">
            <h1 class="title has-text-weight-bold has-text-centered">Register!</h1>
            <form action="/auth/register" method="post">
                @csrf
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <div class="control">
                        <input type="text" name="name" id="name" class="input" placeholder="Jackie Doe"
                            value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="has-text-danger mt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field">
                    <label for="email" class="label">Email</label>
                    <div class="control">
                        <input type="email" name="email" id="email" class="input"
                            placeholder="jackiedoe@example.com" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="has-text-danger mt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field">
                    <label for="password" class="label">Password</label>
                    <div class="control">
                        <input type="password" name="password" id="password" class="input" placeholder="********">
                    </div>
                    @error('password')
                        <p class="has-text-danger mt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    <div class="control">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="input" placeholder="********">
                    </div>
                    @error('password_confirmation')
                        <p class="has-text-danger mt-1 mt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field pt-4">
                    <div class="control">
                        <input type="submit" value="Sign Up!" class="button is-primary is-medium is-fullwidth">
                    </div>
                </div>
            </form>
        </section>
    </main>
</x-layout>
