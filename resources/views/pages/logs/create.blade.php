<x-layout>
    <x-slot:title>
        Create Logs
    </x-slot:title>
    <main class="columns is-centered">
        <section class="column section box is-one-third mt-6">
            <h1 class="title has-text-weight-bold has-text-centered">Create Log</h1>
            <form x-data="data()" x-init="initQuill()" @submit="submit()"
                action="/logbooks/{{ $logbook->id }}/logs" method="post">
                @csrf
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <input class="input" type="text" name="name" id="name"
                        placeholder="Enter the log name..." value="{{ old('name') }}">
                    @error('name')
                        <p class="has-text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="date" class="label">Date</label>
                    <input class="input" type="date" name="date" id="date"
                        value="{{ \Carbon\Carbon::now()->subDay()->toDateString() }}" value="{{ old('date') }}">
                    @error('date')
                        <p class="has-text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="editor" class="label">Description</label>
                    <div x-ref="editor" id="editor"></div>
                    <input x-ref="description" type="hidden" name="description">
                    @error('description')
                        <p class="has-text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field has-text-right">
                    <input type="submit" value="Create" class="button is-primary">
                    <a href="/logbooks/{{ $logbook->id }}/logs" class="button is-dark">Cancel</a>
                </div>
            </form>
        </section>
    </main>
    <x-slot:scripts>
        <script>
            function data() {
                return {
                    initQuill() {
                        new Quill(this.$refs.editor, {
                            theme: 'snow',
                            placeholder: 'Enter log description...'
                        });
                    },
                    submit() {
                        this.$refs.description.value = this.$refs.editor.__quill.root.innerHTML;
                    }
                }
            }
        </script>
    </x-slot:scripts>
</x-layout>
