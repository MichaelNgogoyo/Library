<x-livewire-tables::table.cell>
    <span class="text-gray-700 font-bold">{{$row->title}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <span class="text-gray-700 truncate">{{$row->description}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <span class="text-gray-700 ">{{$row->library->name}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <span class="text-gray-700">{{$row->author->name}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <span class="text-gray-700">{{$row->publisher->name}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <span class="text-gray-700">{{$row->user->name}}</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    <span class="text-gray-700">{{$row->created_at}}</span>
</x-livewire-tables::table.cell>
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

