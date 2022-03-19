<nav class="navbar navbar-expand-md navbar-dark bg-emerald-700">
    <button class="navbar-toggler" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item{{Request::is('/albums/create')? 'active' : ''}}">
                <a class="nav-link" href="{{route('album-create')}}">Create Album</a>
            </li>
        </ul>
    </div>
</nav>
