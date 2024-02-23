<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Collection;

class FieldController extends Controller
{
    /**
     * Display a list of fields for a collection.
     */
    public function index(string $collection_id)
    {
        $collection = Collection::find($collection_id);
        $fields = $collection->fields()->get();
        return view('field.index', ['fields' => $fields, 'collection' => $collection]);
    }

    /**
     * Show the form for creating a new field.
     */
    public function create(string $collection_id)
    {
        $collection = Collection::find($collection_id);
        return view('field.create', ['collection' => $collection]);
    }

    /**
     * Store a newly created field in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'type' => 'required',
            'description' => 'required'
        ]);
       
        $field = Field::create($request->all());

        return redirect()->route('field.index', ['collection_id' => $request->collection_id])->with('message', 'Field ' . $field->fullName() . ' created successfully.');
    }

    /**
     * Show to value of a field for a specific collection and item.
     * Example:
     * GET /collection/TIES/item/1/field/color
     * Gets the 'color' of item 1 in the TIES collection.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing a field.
     * Only the following attributes of a field can be edited:
     * - description
     * - properties
     */
    public function edit(string $collection_id, string $field_id)
    {
        $field = Field::findOrFail(["collection_id" => $collection_id, "name" => $field_id]);
        $collection = $field->collection()->get()->first();
        return view('field.edit', ['field' => $field, 'collection' => $collection]);
    }

    /**
     * Update the specified field in storage.
     */
    public function update(Request $request, string $field_id)
    {
        return redirect()->route('field.index', ['collection_id' => $request->collection_id])->with('message', 'Field ' + $field_id + ' updated successfully.');
    }

    /**
     * Remove the specified field from storage.
     */
    public function destroy(string $collection_id, string $field_id)
    {
        $field = Field::find(["collection_id" => $collection_id, "name" => $field_id]);
        if (!$field)
        {
            return redirect()->route('field.index', ['collection_id' => $collection_id])->with('message', 'Field not found.');
        }

        if ($field->trashed())
        {
            $field->forceDelete();
            return redirect()->route('field.index', ['collection_id' => $collection_id])->with('message', 'Field permanently deleted.');
        }
        else
        {
            $field->delete();
            return redirect()->route('field.index', ['collection_id' => $collection_id])->with('message', 'Field moved to trash.');
        }
    }
}
