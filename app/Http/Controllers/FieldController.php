<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Collection;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $collection_id)
    {
        $collection = Collection::find($collection_id);
        $fields = $collection->fields()->get();
        return view('field.index', ['fields' => $fields, 'collection_id' => $collection_id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($collection_id)
    {
        $item = Field::create([
            'collection_id' => $collection_id,
            'name' => 'example',
            'type' => 'text',
            'description' => 'example description'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
