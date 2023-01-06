<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation" x-data="{ show: false }">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <h1 class="title has-text-weight-bold">B-Log</h1>
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                :aria-expanded="show ? 'true' : 'false'" @click="show = !show" data-target="navmenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu" class="" :class="{ 'is-active': show }" id="navmenu">
            <div class="navbar-end has-text-centered">
                @auth
                    <div class="navbar-item has-text-centered">
                        <span class="is-size-6 has-text-weight-semibold">Welcome, {{ auth()->user()->name }}!</span>
                    </div>
                    <div class="navbar-item">
                        <form class="ml-4" action="/auth/logout" method="post">
                            @csrf
                            <input type="submit" value="Log Out" class="button is-danger is-fullwidth">
                        </form>
                    </div>
                @else
                    <div class="navbar-item">
                        <a href="/auth/signup" class="button is-primary is-fullwidth">Register</a>
                    </div>
                    <div class="navbar-item">
                        <a href="/auth/signin"class="button is-light is-fullwidth">Login</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
