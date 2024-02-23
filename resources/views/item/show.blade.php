@extends('layout.main')

@section('content')
    <div class="container-fluid p-4">
        @foreach ($item->fieldValues()->get() as $fieldValue)
            <div class="col mb-4 p-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $fieldValue->field()->get()->first()->name }}</h5>
                        <h6 class="card-subtitle text-muted">{{ $fieldValue->field()->get()->first()->description }}</h6>
                    </div>
                    <div class="card-body">
                        {{ $fieldValue->value }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
