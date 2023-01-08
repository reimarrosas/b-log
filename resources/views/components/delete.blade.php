@props(['url', 'resource'])
<div x-data="{ modalOpen: false }">
    <button @click="modalOpen = true" class="button is-danger">
        <span class="icon"><i class="fa-solid fa-trash"></i></span>
    </button>
    <div class="modal" :class="{ 'is-active': modalOpen }">
        <div class="modal-background" @click="modalOpen = false"></div>
        <section class="modal-card">
            <header class="modal-card-head">
                <h1 class="modal-card-title has-text-weight-semibold">Delete {{ $resource }} prompt</h1>
            </header>
            <main class="modal-card-body">
                <p class="block">Are you sure you want to delete this {{ $resource }}?</p>
            </main>
            <footer class="modal-card-foot is-flex has-justify-content-center has-align-items-center">

                <form action="{{ $url }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="button is-danger" type="submit" value="Yes">
                </form>
                <button @click="modalOpen = false" class="button is-dark ml-4">No</button>
            </footer>
        </section>
        <button @click="modalOpen = false" class="modal-close is-large" aria-label="close"></button>
    </div>
</div>
