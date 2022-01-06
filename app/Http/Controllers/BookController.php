<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Library;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.books');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
//        dd($request->all());
//          "_token" => "QVRy25HnuIEnORwhfBX88YeHrejVhRIkMvJxxLPi"
//          "title" => "Tempora qui nostrum"
//          "library-id" => "1"
//          "description" => "Placeat recusandae"
//          "author" => "Quo molestiae volupt"
//          "publisher" => "Repudiandae ad dolor"
//          "publish_date" => "2013-06-28"

        try {
              $library = '';
              if ($request->has('library_name') && $request->library_name){
                $lib = Library::firstOrCreate([
                     'name' => $request->library_name,
                ]);
                $library = $lib->id;
              }else{
                  $library = $request->library_id;
              }


            $author = '';
              if ($request->has('author') && $request->author){
                $guy = Author::firstOrCreate([
                     'name' => $request->author,
                ]);
                $author = $guy->id;
              }else{
                  $author = $request->author_id;
              }

            $publisher = '';
              if ($request->has('publisher') && $request->publisher){
                $company = Publisher::firstOrCreate([
                    'name' => $request->publisher
                ]);
                $publisher = $company->id;
              }else{
                  $publisher = $request->publisher_id;
              }

            Book::create([
                'user_id'=>auth()->id(),
                'library_id'=>$library,
                'author_id'=>$author,
                'publisher_id'=>$publisher,
                'title'=>$request->title,
                'description'=>$request->description,
                'publish_date'=>$request->publish_date,
            ]);
              return back()->with('success', 'Book created successfully!');
        }catch (\Throwable $e){
            return back()->with('message', 'Error!: '.$e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
