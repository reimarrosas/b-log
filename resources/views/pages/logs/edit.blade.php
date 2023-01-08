<x-layout>
    <x-slot:title>
        Update Logs
    </x-slot:title>
    <main class="columns is-centered px-2">
        <section class="column section box is-one-third mt-6">
            <h1 class="title has-text-weight-bold has-text-centered">Update Log</h1>
            <form x-data="data()" x-init="initQuill()" @submit="submit()"
                action="/logbooks/{{ $logbook->id }}/logs/{{ $log->id }}" method="post">
                @method('PUT')
                @csrf
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <input class="input" type="text" name="name" id="name" placeholder="Enter the log name..." value="{{ old('name') ?: ($log->name ?? '') }}">
                    @error('name')
                        <p class="has-text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="field">
                    <label for="date" class="label">Date</label>
                    <input class="input" type="date" name="date" id="date" value="{{ old('date') ?: ($log->date ?? '') }}">
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
                <input type="hidden" name="logbook_id" value="5">
                <div class="field has-text-right">
                    <input type="submit" value="Update" class="button is-primary">
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
                        const quill = new Quill(this.$refs.editor, {
                            theme: 'snow',
                            placeholder: 'Enter log description...'
                        });

                        quill.pasteHTML("{!! old('description') ?: ($log->description ?? '') !!}")
                    },
                    submit() {
                        this.$refs.description.value = this.$refs.editor.__quill.root.innerHTML;
                    }
                }
            }
        </script>
    </x-slot:scripts>
</x-layout>

