<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        //load all libraries in page:
        $libs = Library::all();
        return view('admin.libraries', compact('libs'));
    }
}
