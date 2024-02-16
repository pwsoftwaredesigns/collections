@extends('layout.main')

@section('content')

@foreach ($fields as $field)
    <div class="container-fluid p-4">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->created_at }}</td>
                    <td>{{ $field->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endforeach

@endsection