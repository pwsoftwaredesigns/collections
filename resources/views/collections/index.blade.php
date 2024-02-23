@extends('layout.app')

@section('title', 'My Collections')

@section('content')
    <!-- Create a bootstrap grid of cards for each collection -->
    <div class="row row-cols-1 row-cols-md-2">
        @if (count($collections) == 0)
            <div class="card m-4">
                <div class="card-body">
                    <h5 class=" card-title">No collections found</h5>
                    <p class="card-text">{{ ($trashed) ? 'Your trash is empty' : 'You have not created any collections yet' }}</p>
                </div>
            </div>
        @endif

        @foreach ($collections as $id => $value)
            <div class="col mb-4 p-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $value->name }}</h5>
                        <h6 class="card-subtitle text-muted">{{ $value->key }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $value->description }}</p>
                        <div class="d-flex align-items-center">
                            @if (!$trashed)
                                <a href="{{ route('collections.show', ['collection' => $value->key]) }}" class="btn btn-primary mr-2">View Collection</a>
                            @endif
                            <a href="{{ route('fields.index', ['collection' => $value->key]) }}" class="btn btn-secondary mr-2"><i class="bi-list-task"></i> Fields</a>
                            <form action="{{ route('collections.destroy', ['collection' => $value->key]) }}" method="post" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-small btn-danger" type="submit" title="{{ ($trashed) ? 'Permanently delete this collection' : 'Move this collection to the trash' }}"><i class="bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection