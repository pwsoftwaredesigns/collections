@extends('layout.main')

@section('content')
    <div class="container-fluid p-4">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <!--<th>Created At</th>-->
                    <!--<th>Updated At</th>-->
                    @foreach ($fields as $field)
                        <th>{{ $field->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $id => $item)
                    <tr onclick="window.location='{{ route('item.show', ['collection_id' => $collection->key, 'item_id' => $item->id]) }}';" style="cursor: pointer;">
                    <td>{{ $item->id }}</td>
                    <!-- <td>{{ $item->created_at }}</td> -->
                    <!--<td>{{ $item->updated_at }}</td> -->
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
