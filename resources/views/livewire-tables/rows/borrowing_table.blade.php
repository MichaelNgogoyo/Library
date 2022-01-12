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
