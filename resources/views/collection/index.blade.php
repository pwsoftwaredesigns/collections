<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>My Collections</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('collection') }}">My Collections</a></li>
                <li><a href="{{ URL::to('collection/create') }}">Create a Collection</a>
            </ul>
        </nav>

        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <table class="table table-striped table-bordered">
            <tr>
                <th>Key</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
            @foreach ($collections as $id => $value)
                <tr>
                    <td>{{ $value->key }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->description }}</td>

                    <!-- we will also add show, edit, and delete buttons -->
                    <td>

                        <!-- delete the shark (uses the destroy method DESTROY /collection/{key} -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <!-- show the shark (uses the show method found at GET /collection/{key} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('collection/' . $value->key) }}">Show this collection</a>

                        <!-- edit this shark (uses the edit method found at GET /collection/{key}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('collection/' . $value->key . '/edit') }}">Edit this collection</a>

                        <form action="{{ url('collection', $value->key) }}" method="post" class='pull-right'>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-small btn-danger" type="submit">Delete this collection</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </table>

    </div>
</body>

</html>
