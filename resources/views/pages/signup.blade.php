<x-layout>
    <x-slot:title>Register</x-slot:title>
    <main class="columns is-centered">
        <section class="section column is-one-third has-shadow">
            <h1 class="title has-text-weight-bold has-text-centered">Register!</h1>
            <form action="auth/register" method="post">
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <div class="control">
                        <input type="text" name="name" id="name" class="input" placeholder="Jackie Doe">
                    </div>
                    @error('name')
                        <p> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field">
                    <label for="email" class="label">Email</label>
                    <div class="control">
                        <input type="email" email="email" id="email" class="input"
                            placeholder="jackiedoe@example.com">
                    </div>
                    @error('email')
                        <p> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field">
                    <label for="password" class="label">Password</label>
                    <div class="control">
                        <input type="password" password="password" id="password" class="input" placeholder="********">
                    </div>
                    @error('password')
                        <p> {{ $message }} </p>
                    @enderror
                </div>
                <div class="field">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    <div class="control">
                        <input type="password" password_confirmation="password_confirmation" id="password_confirmation"
                            class="input" placeholder="********">
                    </div>
                    @error('password_confirmation')
                        <p> {{ $message }} </p>
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
