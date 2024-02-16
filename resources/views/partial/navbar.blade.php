<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ URL::to('/') }}">
        <i class="bi-collection d-inline-block align-top"></i>
        {{ config("app.name") }}
    </a>
    <div class="ml-auto">
        <a href="{{ URL::to('collection') }}" title="My Collections" class=""><i class="btn btn-secondary bi-collection"></i></a>
        <a href="{{ URL::to('collection/create') }}" title="Create Collection" class=""><i class="btn btn-secondary bi-plus-circle"></i></a>
    </div>
</nav>
