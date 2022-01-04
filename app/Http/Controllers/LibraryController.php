<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //load all libraries in page:
        $libs = Library::latest()->get();
        return view('admin.libraries', compact('libs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|min:3|max:15'
        ]);

        $lib = new Library();
        $lib->name = $request->name;
        $lib->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Library  $appModelsLibrary
     * @return \Illuminate\Http\Response
     */
    public function show(Library $appModelsLibrary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Library  $appModelsLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $appModelsLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Library  $appModelsLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $appModelsLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        $library->delete();
        return back();
    }
}
