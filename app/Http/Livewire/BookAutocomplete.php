<?php

namespace App\Http\Livewire;

use App\Models\Book;

class BookAutocomplete extends Autocomplete
{
    protected $listeners = ['valueSelected'];

    public function valueSelected(Book $book)
    {
        $this->emitUp('bookSelected', $book);
    }

    public function query() {
        return Book::query()->search($this->search)->orderBy('title');
    }

    public function render()
    {
        return view('livewire.book-autocomplete');
    }
}
