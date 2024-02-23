<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //If the $request->trashed then show only the trashed collections
        if ($request->trashed)
        {
            $collections = Collection::onlyTrashed()->get();
            return view('collection.index', ['collections' => $collections, 'trashed' => true]);
        }
        else
        {
            $collections = Collection::all();
            return view('collection.index', ['collections' => $collections, 'trashed' => false]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collection.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|max:8|unique:collections,key',
            'name' => 'required',
            'description' => 'required'
        ]);
       
        Collection::create($request->all());

        return redirect()->route('collection.index')->with('message', 'Collection created successfully.');
    }

    /**
     * Display the specified resource.
     * Display the items in the collection
     */
    public function show(string $id)
    {
        $collection = Collection::find($id);
        $items = $collection->items()->get();
        $fields = $collection->fields()->get();

        return view('collection.show', ['collection' => $collection, 'items' => $items, 'fields' => $fields]);
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
        $collection = Collection::withTrashed()->find($id);
        if ($collection->trashed())
        {
            $collection->forceDelete();
            return redirect()->route('collection.index')->with('message', 'Collection permanently deleted.');
        }
        else
        {
            $collection->delete();
            return redirect()->route('collection.index')->with('message', 'Collection moved to trash.');
        }
    }
}
