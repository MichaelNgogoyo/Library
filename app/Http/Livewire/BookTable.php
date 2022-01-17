<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Book;

class BookTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Title')
                ->sortable()
                ->searchable(),
            Column::make('Description')
                ->sortable()
                ->searchable(),
            Column::make('Library', 'library.name')
                ->searchable()
                ->sortable(),
            Column::make('Author', 'author.name')
            ->searchable()
                ->sortable(),
            Column::make('Publisher', 'publisher.name')
            ->searchable()
                ->sortable(),
            Column::make('Staff', 'user.name')
            ->searchable()
                ->sortable(),
            Column::make('Created At')
                ->sortable(),
            Column::make('Actions')

        ];
    }

    public function query(): Builder
    {
        return Book::query()->latest();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.book_table';
    }
}
