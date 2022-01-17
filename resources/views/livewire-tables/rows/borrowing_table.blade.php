<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->user->name}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->book->title}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->date_borrowed}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->return_date}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->actual_return_date ?? '------'}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->return_condition ?? '------'}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->created_at}}</span>
</x-livewire-tables::table.cell>
{{--actions--}}
<x-livewire-tables::table.cell>
     <div class="flex">
        <a href="#" class="mr-5" title="Edit book">
            <i class="far fa-edit text-gray-600"></i>
        </a>

        <a href="#" title="Delete book">
            <i class="far fa-trash-alt text-red-600 "></i>
        </a>
     </div>
</x-livewire-tables::table.cell>
