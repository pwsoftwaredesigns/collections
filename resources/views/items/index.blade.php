@extends('layout.app')

@section('title', $collection->name)

@section('navbar.buttons')
    @parent
    <a class="btn btn-secondary" href="{{ route('items.create', ['collection' => $collection->key]) }}" title="Create Item" class=""><i class="bi-plus-circle"></i> Item</a>
@endsection

@section('content')
    <div class="container-fluid p-4">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    @foreach ($fields as $field)
                        <th>{{ $field->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $id => $item)
                    <tr onclick="window.location='{{ route('items.show', ['collection' => $collection->key, 'item' => $item->id]) }}';" style="cursor: pointer;">
                    <td>{{ $item->fullId() }}</td>
                    @foreach ($fields as $field)
                        <td>
                            @php
                                $fieldValue = $item->fieldValues()->where('field_id', $field->name)->first();
                                if ($fieldValue)
                                {
                                    echo $fieldValue->value;
                                }
                            @endphp
                        </td>
                    @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
