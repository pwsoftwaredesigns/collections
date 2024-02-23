<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Collection;
use App\Models\ItemFieldValueText;

class ItemController extends Controller
{
    /**
     * Display a list of the collection's items.
     */
    public function index($collection_id)
    {
        $collection = Collection::findOrFail($collection_id);
        $items = $collection->items()->get();
        $fields = $collection->fields()->get();

        return view('items.index', ['collection' => $collection, 'items' => $items, 'fields' => $fields]);
    }

    /**
     * Show the form for creating a new item.
     */
    public function create(string $collection_id)
    {
        $collection = Collection::find($collection_id);
        
        return view('items.create', ['collection' => $collection]);
    }

    /**
     * Store a newly created item in storage.
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

        return redirect()->route('items.index', ['collection' => $request->collection_id])->with('message', 'Item ' . $item->fullId() . ' created successfully.');
    }

    /**
     * Display the specified item.
     */
    public function show(string $collection_id, string $item_id)
    {
        $item = Item::findOrFail(['collection_id' => $collection_id, 'id' => $item_id]);
        $collection = $item->collection()->first();
        return view('items.show', ['collection' => $collection, 'item' => $item]);
    }

    /**
     * Show the form for editing the specified item.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy($collection_id, $id)
    {
        $item = Item::find(["collection_id" => $collection_id, "id" => $id]);
        if (!$item)
        {
            return redirect()->route('items.index', ['collection' => $collection_id])->with('message', 'Item not found.');
        }

        $item->delete();

        return redirect()->route('items.index', ['collection' => $collection_id])->with('message', 'Item ' . $item->fullId() . ' deleted.');
    }
}
