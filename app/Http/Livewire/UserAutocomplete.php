<?php

namespace App\Http\Livewire;


use App\Models\User;

class UserAutocomplete extends Autocomplete
{
    protected $listeners = ['valueSelected'];

    public function valueSelected(User $user)
    {
        $this->emitUp('userSelected', $user);
    }

    public function query() {
//        return User::where('name', 'like', '%'.$this->search.'%')->orderBy('name');
        return User::query()->role('student')->search($this->search)->orderBy('name');
    }
}
