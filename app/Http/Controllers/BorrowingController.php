<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        return view('admin.borrowings');
    }

    public function store(Request $request)
    {
//        dd(User::where('name', $request->student)->first()->id,);
        $b = Borrowing::create([
            'user_id' => User::where('name', $request->student)->first()->id,
            'book_id' => Book::where('title', $request->book)->first()->id,
            'date_borrowed' => $request->lend_date,
            'return_date' => $request->return_date,
        ]);

        return back()->with('success', 'Lending record created with ID: #'.$b->id);

    }
}
