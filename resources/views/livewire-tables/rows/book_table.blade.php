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
    <div class="flex"  x-data="{showDelete:false, newAuthor:false, newPublisher:false, showEdit:false, deleteBook:null, editingBook:null}"
         class="bg-white
    shadow
                    overflow-hidden sm:rounded-md">
        <div>
            <a href="#" class="mr-5" title="Edit book"
                @click.prevent="showEdit = true; editingBook = {{$row}}; ">
                <i class="far fa-edit text-gray-600"></i>
            </a>

            <a href="#" title="Delete book"
                @click.prevent="showDelete = true; deleteBook = {{$row}}">
                <i class="far fa-trash-alt text-red-600 "></i>
            </a>
        </div>
        <div>
            <div>
            {{--Edit model--}}
                <div x-show="showEdit" class="fixed z-10 inset-0 overflow-y-auto"
                     aria-labelledby="modal-title" role="dialog"
                     aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                             aria-hidden="true"
                             x-show="showEdit"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-100"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                        ></div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                              aria-hidden="true">&#8203;</span>
                        <div
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                            x-show="showEdit"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <form method="POST" x-bind:action="`update/books/${editingBook.id}`">
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
                                            Edit Book
                                        </h3>
                                        <div class="mt-2">
                                            <div class="space-y-8 divide-y divide-gray-200">
                                                  <div class="space-y-8 divide-y divide-gray-200">
                                                    <div>
                                                      <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                        <div class="sm:col-span-4">
                                                          <label for="title" class="block text-sm font-medium text-gray-700">
                                                            Book Title
                                                          </label>
                                                          <div class="mt-1">
                                                            <input x-bind:value="editingBook.title" required id="title" name="title"
                                                                   type="text"
                                                                   autocomplete="title"
                                                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block
                                                                   w-full sm:text-sm border-gray-300 rounded-md">
                                                          </div>
                                                        </div>

                                                        <div class="sm:col-span-4">
                                                          <label for="library_id" class="block text-sm font-medium text-gray-700">
                                                            Associated Library
                                                          </label>
                                                          <div class="mt-1">
                                                              @php
                                                                $libs = \App\Models\Library::all(['id','name']);
                                                              @endphp
                                                              @if($libs->count() > 0)
                                                                <select id="country" name="library_id" autocomplete="library_id"
                                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                                  @foreach($libs as $lib)
                                                                    <option x-bind:selected="editingBook.library_id === {{$lib->id}}"
                                                                            value="{{$lib->id}}">{{$lib->name}}</option>
                                                                   @endforeach
                                                                </select>
                                                              @else
                                                                <p class="text-red-600">Please add libraries first</p>
                                                               @endif
                                                          </div>
                                                        </div>

                                                        <div class="sm:col-span-6">
                                                          <label for="about" class="block text-sm font-medium text-gray-700">
                                                            Description
                                                          </label>
                                                          <div class="mt-1">
                                                            <textarea required id="description" name="description" rows="3" class="shadow-sm
                                                            focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm
                                                            border-gray-300 rounded-md" x-text="editingBook.description"></textarea>
                                                          </div>
                                                          <p class="mt-2 text-sm text-gray-500">General description of the book.</p>
                                                        </div>

                                                        <div class="sm:col-span-4">
                                                          <label for="author" class="block text-sm font-medium text-gray-700">
                                                            Author
                                                          </label>
                                                          <div class="mt-1">
                                                              <div class="mt-1 flex rounded-md shadow-sm">
                                                                <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                                 @php
                                                                    $authors = \App\Models\Author::all(['id','name']);
                                                                  @endphp
                                                                      @if($authors->count() > 0)
                                                                        <select x-show="!newAuthor" id="country" name="author_id"
                                                                                autocomplete="author_id"
                                                                                class="shadow-sm focus:ring-indigo-500
                                                                                focus:border-indigo-500 block w-full sm:text-sm
                                                                                border-gray-300 rounded-md">
                                                                          @foreach($authors as $author)
                                                                            <option x-bind:selected="editingBook.author_id ==={{$author->id}}" value="{{$author->id}}">{{$author->name}}</option>
                                                                           @endforeach
                                                                        </select>

                                                                      @else
                                                                        <p class="text-red-600">Please add authors first</p>
                                                                       @endif
                                                                </div>

                                                              </div>
                                                          </div>
                                                        </div>

                                                          <div class="sm:col-span-4">
                                                              <label for="email" class="block text-sm font-medium text-gray-700">
                                                                Publisher
                                                              </label>
                                                              <div class="mt-1">
                                                                  <div class="mt-1 flex rounded-md shadow-sm">
                                                                    <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                                          @php
                                                                            $publishers = \App\Models\Publisher::all(['id','name']);
                                                                          @endphp
                                                                          @if($publishers->count() > 0)
                                                                            <select x-show="!newPublisher" id="country" name="publisher_id"
                                                                                    autocomplete="publisher_id"
                                                                                    class="shadow-sm focus:ring-indigo-500
                                                                                    focus:border-indigo-500 block w-full sm:text-sm
                                                                                    border-gray-300 rounded-md">
                                                                              @foreach($publishers as $publisher)
                                                                                <option x-bind:selected="editingBook.publisher_id
                                                                                ==={{$publisher->id}}"
                                                                                    value="{{$publisher->id}}">{{$publisher->name}}</option>
                                                                               @endforeach
                                                                            </select>

                                                                          @else
                                                                            <p class="text-red-600">Please add publishers first</p>
                                                                           @endif
                                                                    </div>

                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="sm:col-span-4">
                                                              <label for="email" class="block text-sm font-medium text-gray-700">
                                                                Published At
                                                              </label>

                                                               <div class="mt-1">
                                                                  <div class="mt-1 flex rounded-md shadow-sm">
                                                                    <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                                      <input x-bind:value="editingBook.publish_date" type="date"
                                                                             name="publish_date" id="email"
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
            </div>
            <div>
                {{-- Delete model--}}
                <div x-show="showDelete" class="fixed z-10 inset-0 overflow-y-auto"
                     aria-labelledby="modal-title" role="dialog"
                     aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                             aria-hidden="true"
                             x-show="showDelete"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-100"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                        ></div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                              aria-hidden="true">&#8203;</span>


                        <div
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6"
                            x-show="showDelete"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <!-- Heroicon name: outline/exclamation -->
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                         aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900"
                                        id="modal-title">
                                        Delete Book
                                    </h3>
                                    <div class="mt-2 pr-4">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete book: <strong x-text="deleteBook.title" class="underline
                                          decoration-red-500 decoration-2 underline-offset-1"></strong>?
                                            <br>
                                            <strong>
                                                All data associated will be permanently removed <br>from our
                                                servers forever This action cannot be undone.
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <form method="POST" :action="`delete/books/${deleteBook.id}`">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full inline-flex
                                        justify-center rounded-md border
                                        border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Delete
                                    </button>
                                </form>
                                <button @click.prevent="showDelete = false; deleteBook = null"
                                        type="button" class="mt-3
                                    w-full inline-flex justify-center rounded-md border
                                    border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-livewire-tables::table.cell>

