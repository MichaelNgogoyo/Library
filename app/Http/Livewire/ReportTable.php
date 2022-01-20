<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Borrowing;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class ReportTable extends DataTableComponent
{

    public $user;
    public array $bulkActions = [
        'deleteSelected' => 'Delete',
    ];

    public function mount(User $user = null){
        if ($user){
            $this->user = $user;
        }
        if (!auth()->user()->hasRole('librarian')){
            $this->bulkActions = [];
        }
    }

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
            Column::make('Approved'),
            Column::make('Created', 'created_at')
            ->sortable()->searchable(),
            Column::make('Actions')

        ];
    }

    public function query(): Builder
    {
        if ($this->user->id){
            return Borrowing::query()->where('user_id',$this->user->id);
        }

        return Borrowing::query();

    }

    public function filters(): array
    {
        return [
            'type' => Filter::make('User Type')
                ->select([
                    '' => 'Any',
                ]),
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            'verified' => Filter::make('E-mail Verified')
                ->select([
                    '' => 'Any',
                    1 => 'Yes',
                    0 => 'No',
                ]),
             'date' => Filter::make('Date')
                ->date([
                    'min' => now()->subYear()->format('Y-m-d'), // Optional
                    'max' => now()->format('Y-m-d') // Optional
                ]),
             'tags' => Filter::make('Tags')
                ->multiSelect([
                    'tag1' => 'Tags 1',
                    'tag2' => 'Tags 2',
                    'tag3' => 'Tags 3',
                    'tag4' => 'Tags 4',
                ]),
        ];
    }

    public function deleteSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            foreach ($this->selectedRowsQuery->get() as $row){
                $row->delete();
            }
            session()->flash('live_message',['message'=>'You did not select any records to delete.', 'type'=>'green']);
        }else{
            // Not included in package, just an example.
            session()->flash('live_message',['message'=>'You did not select any records to delete.', 'type'=>'red']);
        }

    }

    public function approve(Borrowing $borrowing, $disapprove = false)
    {
        $borrowing->approved = $disapprove ? 0 : 1;
        $borrowing->save();
    }



    public function rowView(): string
    {
        return 'livewire-tables.rows.borrowing_table';
    }
}
