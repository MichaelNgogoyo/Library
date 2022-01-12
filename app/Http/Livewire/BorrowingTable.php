<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Borrowing;

class BorrowingTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Borrowed By', 'user.name')
            ->sortable()->searchable(),
            Column::make('Book', 'book.title')
            ->sortable()->searchable(),
            Column::make('Borrowing Date', 'date_borrowed')
            ->sortable()->searchable(),
            Column::make('Return Date', 'return_date')
            ->sortable()->searchable(),
            Column::make('Actual Return Date', 'actual_return_date')
            ->sortable()->searchable(),
             Column::make('Return condition', 'return_condition')
            ->sortable()->searchable(),
            Column::make('Created', 'created_at')
            ->sortable()->searchable(),


        ];
    }

    public function query(): Builder
    {
        return Borrowing::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.borrowing_table';
    }
}
