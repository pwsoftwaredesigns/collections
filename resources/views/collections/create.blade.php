@extends('layout.app')

@section('title', 'Create a Collection')

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      Create a Collection
    </div>
    <div class="card-body">
      <form name="create-collection-form" id="create-collection-form" method="post" action="{{ route('collections.index') }}">
       @csrf
        <div class="form-group">
          <label for="key">Key</label>
          <input type="text" id="key" name="key" class="form-control" required="" maxlength="8">
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" class="form-control" required="">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control">
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@endsection
