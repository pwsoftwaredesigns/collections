<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ URL::to('/') }}">
        <i class="bi-collection d-inline-block align-top"></i>
        {{ config("app.name") }}
    </a>
    <div class="ml-auto">
        @section('navbar.buttons')
            <a class="btn btn-secondary" href="{{ route('collections.index') }}" title="My Collections" class=""><i class="bi-collection"></i> My Collections</a>
            <a class="btn btn-secondary" href="{{ route('collections.create') }}" title="Create Collection" class=""><i class=" bi-plus-circle"></i> Collection</a>
        @show
    </div>
</nav>
