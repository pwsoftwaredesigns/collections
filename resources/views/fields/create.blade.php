@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Create a field for the collection "{{ $collection->name }}"
        </div>
        <div class="card-body">
            <form name="create-field-form" id="create-field-form" method="post" action="{{ route('fields.store', ['collection'=>$collection->key]) }}">
                @csrf
                <input type="hidden" name="collection_id" value="{{ $collection->key }}">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select wire:model="type" id="type" name="type" class="form-control">
                        <option value="" disabled selected="selected">Select an type...</option>
                        <option value="shorttext">Short Text</option>
                        <option value="longtext">Long Text</option>
                        <option value="number">Number</option>
                    </select>
                </div>

                <!-- User Livewire to display optional properties based on the selected type -->

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
