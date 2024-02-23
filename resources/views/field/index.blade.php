@extends('layout.main')

@section('content')
    <div class="container-fluid p-4">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fields as $field)
                    <tr>
                        <td>{{ $field->name }}</td>
                        <td>{{ $field->created_at }}</td>
                        <td>{{ $field->updated_at }}</td>
                        <td>
                            <a href="{{ url('collection/'.$collection->key.'/field/'.$field->name.'/edit') }}" class="btn btn-primary"><i class="bi-pencil"></i></a>
                            <form action="{{ url('collection/'.$collection->key.'/field/'.$field->name) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection