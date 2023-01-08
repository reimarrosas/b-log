<x-layout>
    <x-slot:title>
        Logs
    </x-slot:title>
    <main class="columns is-centered px-2">
        <section class="column is-half mt-6">
            <h1 class="title has-text-weight-bold has-text-centered">Logs</h1>
            <div class="is-flex is-justify-content-space-between is-align-items-center mb-4">
                <a href="/logbooks" class="button is-dark">Back</a>
                <a href="/logbooks/{{ $logbook->id }}/logs/create" class="button is-primary">Create</a>
            </div>
            @foreach ($logs as $log)
                <article class="card mb-4">
                    <header class="card-header">
                        <h1 class="card-header-title"><time>{{ $log->date }}</time> | {{ $log->name }}</h1>
                    </header>
                    <main class="card-content">
                        <div class="content">
                            {!! $log->description !!}
                        </div>
                    </main>
                    <footer class="card-footer" x-data="{ modalOpen: false }">
                        <a href="/logbooks/{{ $logbook->id }}/logs/{{ $log->id }}/edit"
                            class="card-footer-item">Edit</a>
                        <a @click="modalOpen = true" class="card-footer-item" role="button">Delete</a>
                        <div class="modal" :class="{ 'is-active': modalOpen }">
                            <div class="modal-background" @click="modalOpen = false"></div>
                            <section class="modal-card">
                                <header class="modal-card-head">
                                    <h1 class="modal-card-title has-text-weight-semibold">Delete log
                                        prompt</h1>
                                </header>
                                <main class="modal-card-body">
                                    <p class="block">Are you sure you want to delete this log?</p>
                                </main>
                                <footer
                                    class="modal-card-foot is-flex has-justify-content-center has-align-items-center">

                                    <form action="/logbooks/{{ $logbook->id }}/logs/{{ $log->id }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input class="button is-danger" type="submit" value="Yes">
                                    </form>
                                    <button @click="modalOpen = false" class="button is-dark ml-4">No</button>
                                </footer>
                            </section>
                            <button @click="modalOpen = false" class="modal-close is-large" aria-label="close"></button>
                        </div>
                    </footer>
                </article>
            @endforeach
        </section>
    </main>
    @if (session()->has('create_success'))
        <x-flash :flash_name="'create_success'" />
    @elseif (session()->has('update_success'))
        <x-flash :flash_name="'update_success'" />
    @elseif (session()->has('delete_success'))
        <x-flash :flash_name="'delete_success'" />
    @endif
</x-layout>
