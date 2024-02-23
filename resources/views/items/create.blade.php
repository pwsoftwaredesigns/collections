@extends('layout.app')

@section('content')
    <div class="container-fluid p-4">
        <form action="{{ route('items.store', ['collection' =>  $collection->key]) }}" method="POST">
            @csrf
            <input type="hidden" name="collection_id" value="{{ $collection->key }}">

            @foreach ($collection->fields()->get() as $field)
                <div class="col mb-4 p-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $field->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $field->description }}</h6>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="{{ $field->name }}">
                        </div>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
