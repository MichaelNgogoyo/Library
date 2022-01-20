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
    public function studentIndex()
    {
        return view('students.borrowings');
    }

    public function store(Request $request)
    {
        $b = Borrowing::create([
            'user_id' => User::where('name', $request->student)->first()->id,
            'book_id' => Book::where('title', $request->book)->first()->id,
            'date_borrowed' => $request->lend_date,
            'return_date' => $request->return_date,
            'approved' => 1 //approved
        ]);

        return back()->with('success', 'Lending record created with ID: #'.$b->id);

    }

    public function storeStudent(Request $request)
    {
        $b = Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => Book::where('title', $request->book)->first()->id,
            'date_borrowed' => $request->lend_date,
            'return_date' => $request->return_date,
        ]);

        return back()->with('success', 'Lending record created with ID: #'.$b->id);

    }
    public function update(Request $request, Borrowing $borrowing)
    {
        if (!$request->book && !$request->lend_date && !$request->return_date){
            return back()->with('message', 'Record should not be empty!');
        }

        if ($request->book){
            $borrowing->book_id = Book::where('title', $request->book)->first()->id;
        }
        if ($request->lend_date){
            $borrowing->date_borrowed = $request->lend_date;
        }
        if ($request->return_date){
            $borrowing->return_date = $request->return_date;
        }
        $borrowing->save();

        return back()->with('success', 'Lending record updated');

    }

    public function returnBook()
    {
        // set return date, condition and fines
    }
}
