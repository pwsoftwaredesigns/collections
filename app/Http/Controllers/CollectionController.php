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
        $collections = Collection::all();
        return View::make('collection.index')->with('collections', $collections);
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
     */
    public function show(string $id)
    {
        $collection = Collection::find($id);

        return view('collection.show')->with('collection', $collection);
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
        $collection = Collection::find($id);
        if ($collection->trashed())
        {
            $collection->forceDelete();
            return redirect()->route('collection.index')->with('message', 'Collection permanently deleted.');
        }
        else
        {
            $collection->delete();
            return redirect()->route('collection.index')->with('message', 'Collection deleted.');
        }
    }
}
