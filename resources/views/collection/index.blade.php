@extends('layout.main')

@section('content')
    <!-- Create a bootstrap grid of cards for each collection -->
    <div class="row row-cols-1 row-cols-md-2">
        @if (count($collections) == 0)
            <div class="card">
                <div class="card-body">
                    <h5 class=" card-title">No collections found</h5>
                    <p class="card-text">You have not created any collections yet.</p>
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
                            <a href="{{ URL::to('collection/' . $value->key) }}" class="btn btn-primary mr-2">View Collection</a>
                            <form action="{{ url('collection', $value->key) }}" method="post" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-small btn-danger" type="submit" title="Move this collection to the trash"><i class="bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection