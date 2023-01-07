<x-layout>
    <x-slot:title>
        Logbooks
    </x-slot:title>
    <main class="container pt-6">
        <h1 class="title has-text-weight-bold has-text-centered">Logbooks</h1>
        <div class="has-text-right">
            <a href="/logbooks/create" class="button is-primary">Create</a>
        </div>
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logbooks as $logbook)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="has-text-weight-bold">{{ $logbook->name }}</td>
                        <td class="is-flex is-align-items-center">
                            <a class="button is-warning mr-2" href="/logbooks/{{ $logbook->id }}/edit">
                                <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                            </a>
                            <x-delete :url="'/logbooks/' . $logbook->id" :resource="'logbook'" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    @if (session()->has('create_success'))
        <x-flash :flash_name="'create_success'" />
    @elseif (session()->has('update_success'))
        <x-flash :flash_name="'update_success'" />
    @elseif (session()->has('delete_success'))
        <x-flash :flash_name="'delete_success'" />
    @endif
</x-layout>
