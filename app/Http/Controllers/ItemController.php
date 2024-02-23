<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Collection;
use App\Models\ItemFieldValueText;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $collection_id)
    {
        $collection = Collection::find($collection_id);
        
        return view('item.create', ['collection' => $collection]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'collection_id' => 'required'
        ]);

        $collection = Collection::find($request->collection_id);

        //Create a new item in the collection
        $item = $collection->items()->create();

        //Create values for each field
        $fields = $collection->fields()->get();
        foreach ($fields as $field)
        {
            ItemFieldValueText::create([
                'collection_id' => $collection->key,
                'item_id' => $item->id,
                'field_id' => $field->name,
                'value' => $request->input($field->name)
            ]);
        }

        return redirect()->route('collection.show', ['collection_id' => $request->collection_id])->with('message', 'Item ' . $item->fullId() . ' created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $collection_id, string $item_id)
    {
        $item = Item::findOrFail(['collection_id' => $collection_id, 'id' => $item_id]);
        return view('item.show', ['item' => $item]);
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
