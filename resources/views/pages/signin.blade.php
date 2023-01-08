<x-layout>
    <x-slot:title>Login</x-slot:title>
    <main class="columns is-centered px-2">
        <section class="section column is-one-third box mt-6">
            <h1 class="title has-text-weight-bold has-text-centered">Login!</h1>
            @error('login_failure')
                <div class="notification is-danger">
                    {{ $message }}
                </div>
            @enderror
            <form action="/auth/login" method="post">
                @csrf
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
                <div class="field pt-4">
                    <div class="control">
                        <input type="submit" value="Sign In!" class="button is-primary is-medium is-fullwidth">
                    </div>
                </div>
            </form>
        </section>
    </main>
    @if (session()->has('register_success'))
        <x-flash :flash_name="'register_success'" />
    @endif
</x-layout>
