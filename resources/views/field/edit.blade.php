@extends('layout.main')

@section('content')
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Edit field "{{ $field->name }}" for the collection {{ $collection->name }}"
        </div>
        <div class="card-body">
            <form name="create-field-form" id="create-field-form" action="{{ url('collection/'.$collection->key.'/field') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="collection_id" value="{{ $collection->key }}">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required="" value="{{ $field->name }}" readonly >
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" required="" value="{{ $field->description }}">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select wire:model="type" id="type" name="type" class="form-control" value="{{ $field->type }}" readonly>
                        <option value="shorttext">Short Text</option>
                        <option value="longtext">Long Text</option>
                        <option value="number">Number</option>
                    </select>
                </div>

                <!-- User Livewire to display optional properties based on the selected type -->

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
