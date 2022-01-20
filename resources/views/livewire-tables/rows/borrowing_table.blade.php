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
 <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold font-medium {{$row->approved ? 'bg-green-200':
 'bg-yellow-200'}}
 {{$row->approved ? 'text-green-800': 'text-orange-800'}}">
  {{$row->approved ? 'APPROVED': 'PENDING'}}
</span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
 <span class="text-gray-700">{{$row->created_at->diffForHumans()}}</span>
</x-livewire-tables::table.cell>
{{--actions--}}
<x-livewire-tables::table.cell>
     <div class="flex" x-data="{showEdit: false, newAuthor:false, newPublisher:false, showReturn:false}">
         @if($row->approved)
               <button class="mr-5 {{$row->approved? 'opacity-50':'opacity-100'}}"
                    title="Edit book">
                   <i class="far fa-remove-format text-gray-500"></i>
            </button>
         @else
            <button @click="showEdit = !showEdit;" class="mr-5"
                    title="Edit book">
                <i class="far fa-edit text-gray-600"></i>
            </button>
         @endif
         @if(auth()->user()->hasRole('librarian'))
          <button title="Return book" @click="showReturn = !showReturn" class="mr-5">
                  <i class="fad fa-undo-alt text-gray-600"></i>
            </button>
            @if($row->approved)
                 <button wire:click="approve({{$row->id}}, {{true}})" title="dis-approve borrowing" class="mr-5">
                     <i class="fad fa-times-circle text-gray-600"></i>
                </button>
             @else
                <button wire:click="approve({{$row->id}})" title="approve borrowing" class="mr-5">
                      <i class="fad fa-check text-gray-600"></i>
                </button>
            @endif

         @endif

    {{--    modals--}}
        <div x-show="showEdit" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" x-show="showEdit"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-100"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                  aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 min-w-[44vw] max-h-[80vh] overflow-auto"
                x-show="showEdit"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <form method="POST" action="{{route('student.update.borrowings', $row->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full
                    bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                id="modal-title">
                                Update record a book
                            </h3>
                            <div class="mt-2">
                                <div class="space-y-8 divide-y divide-gray-200">

                                      <div class="space-y-8 divide-y divide-gray-200">
                                        <div>
                                          <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6 md:grid-cols-8">
                                           <div class="sm:col-span-4 md:col-span-4">
                                              <label for="title" class="block text-sm font-medium text-gray-700">
                                                Assign Book
                                              </label>
                                              <div class="mt-1">
                                                @livewire('book-autocomplete')
                                                  <span class="text-sm text-gray-800">Current: {{$row->book->title}}</span>
                                              </div>
                                            </div>

                                           <div class="sm:col-span-4 md:col-span-4">
                                              <label for="title" class="block text-sm font-medium text-gray-700">
                                                Lending Date
                                              </label>
                                              <div class="mt-1">
                                               <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                  <input type="date" value="{{$row->date_borrowed}}" :min="new Date().toISOString()
                                                  .split
                                                  ('T')[0]"
                                                         name="lend_date"
                                                         id="lend_date"
                                                        class="focus:ring-indigo-500
                                                  focus:border-indigo-500 block w-full rounded-none rounded-md
                                                  sm:text-sm border-gray-300" />
                                              </div>
                                              </div>
                                            </div>
                                           <div class="sm:col-span-4 md:col-span-4">
                                              <label for="title" class="block text-sm font-medium text-gray-700">
                                                Return Date
                                              </label>
                                              <div class="mt-1">
                                                <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                      <input type="date" value="{{$row->return_date}}" :min="new Date().toISOString().split
                                                      ('T')[0]"
                                                             name="return_date" id="return_date"
                                                            class="focus:ring-indigo-500
                                                      focus:border-indigo-500 block w-full rounded-none rounded-md
                                                      sm:text-sm border-gray-300" />
                                                  </div>
                                              </div>
                                            </div>
                                        </div>


                                      </div>

                                    </div>
                                </div>
                            </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                  text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-800 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-gray-500">
                                Save
                            </button>
                            <button @click="showEdit = false;"
                                    type="reset" class="mt-3
                w-full inline-flex justify-center rounded-md border
                border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                        </div>
                        </div>
                </form>
            </div>
            </div>
            </div>

        {{--return--}}
         <div x-show="showReturn" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" x-show="showReturn"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-100"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                  aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 min-w-[44vw] max-h-[80vh] overflow-auto"
                x-show="showReturn"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <form method="POST" action="{{route('student.update.borrowings', $row->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full
                    bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                id="modal-title">
                                Return Book: #{{$row->book->id}} ({{$row->book->title}})
                            </h3>
                            <div class="mt-2">
                                <div class="space-y-8 divide-y divide-gray-200">

                                      <div class="space-y-8 divide-y divide-gray-200">
                                        <div>
                                          <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                           <div class="sm:col-span-4">
                                              <label for="title" class="block text-sm font-medium text-gray-700">
                                                What is the return condition of the book?
                                              </label>
                                              <div class="mt-1">
                                                 <textarea required id="description" name="return_condition" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                              </div>
                                            </div>

                                           <div class="sm:col-span-4">
                                              <label for="title" class="block text-sm font-medium text-gray-700">
                                                Any fines?
                                              </label>
                                              <div class="mt-1">
                                               <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                  <input type="number" name="fine"
                                                         class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                              </div>
                                                  <p>Please note the fine breakdown in the description</p>
                                              </div>
                                            </div>
                                        </div>


                                      </div>

                                    </div>
                                </div>
                            </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm
                  text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-800 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-gray-500">
                                Save
                            </button>
                            <button @click="showReturn = false;"
                                    type="reset" class="mt-3
                w-full inline-flex justify-center rounded-md border
                border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                        </div>
                        </div>
                </form>
            </div>
            </div>
            </div>
     </div>







     @if (session()->has('live_message'))
             <div class="rounded-md bg-{{session('live_message')->type}}-50 p-4 m-0 m-auto w-[50%] mt-2 shadow-lg"
                 x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter-end="opacity-100"
                  x-transition:leave="transition ease-in duration-300"
                  x-transition:leave-start="opacity-100"
                  x-transition:leave-end="opacity-0"
            >
              <div class="flex">
                <div class="flex-shrink-0">
                  <!-- Heroicon name: solid/check-circle -->
                  <svg class="h-5 w-5 text-{{session('live_message')->type}}-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-{{session('live_message')->type}}-800">
                      {{ session('live_message')->message }}
                  </p>
                </div>
              </div>
            </div>
        @endif
</x-livewire-tables::table.cell>
