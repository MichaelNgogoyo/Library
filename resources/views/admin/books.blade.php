<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Books') }}
        </h2>
    </x-slot>

      <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-12" x-data="{showCreate: false, newAuthor:false, newPublisher:false}">
        <h1 class="text-base text-2xl text-gray-700">Master Book List
           <button @click="showCreate = !showCreate" class="inline-flex w-[max-content]  ml-5 items-center px-2.5 py-1.5 border
           border-transparent text-xs font-medium rounded text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2
           focus:ring-offset-2 focus:ring-gray-700">
             <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
              </svg>
              Create New Entry
            </button>
        </h1>
        <main class="flex-1 flex overflow-hidden  mt-6">
            <livewire:book-table />

             {{-- Update modal--}}
                <div x-show="showCreate" class="fixed z-10 inset-0 overflow-y-auto"
                     aria-labelledby="modal-title" role="dialog"
                     aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                             aria-hidden="true"
                             x-show="showCreate"
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
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl
                            transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 min-w-[44vw] max-h-[80vh] overflow-auto"
                            x-show="showCreate"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <form method="POST" action="{{route('store.book')}}">
                                @csrf
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
                                            Add Book
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
                                                            <input required id="title" name="title" type="text" autocomplete="title"
                                                                   class="shadow-sm                                                       focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
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
                                                                    <option value="{{$lib->id}}">{{$lib->name}}</option>
                                                                   @endforeach
                                                                </select>
                                                              @else
                                                                <input id="name" name="library_name" type="text" autocomplete="name"
                                                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                               @endif
                                                          </div>
                                                        </div>

                                                        <div class="sm:col-span-6">
                                                          <label for="about" class="block text-sm font-medium text-gray-700">
                                                            Description
                                                          </label>
                                                          <div class="mt-1">
                                                            <textarea required id="description" name="description" rows="3" class="shadow-sm
                                                            focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
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
                                                                                border-gray-300 rounded-l-md">
                                                                          @foreach($authors as $author)
                                                                            <option value="{{$author->id}}">{{$author->name}}</option>
                                                                           @endforeach
                                                                        </select>
                                                                          <input x-show="newAuthor" type="text" name="author" id="author"
                                                                             class="focus:ring-indigo-500
                                                                      focus:border-indigo-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-300" placeholder="John Doe">
                                                                      @else
                                                                      <input type="text" name="author" id="author"
                                                                             class="focus:ring-indigo-500
                                                                      focus:border-indigo-500 block w-full rounded-none rounded-l-md
                                                                      sm:text-sm border-gray-300" placeholder="John Doe">
                                                                       @endif
                                                                </div>
                                                                <button x-bind:disabled="{{$authors->count() === 0}}" @click.prevent="newAuthor = !newAuthor" class="-ml-px
                                                                relative inline-flex items-center space-x-2 px-4 py-2 border  text-sm font-medium rounded-r-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 "
                                                                    x-bind:class="newAuthor? 'border-emerald-300 text-emerald-700 bg-emerald-50                      hover:bg-emerald-100 focus:ring-emerald-500 focus:border-emerald-500':'border-gray-300                         text-gray-700 bg-gray-50 hover:bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500'"
                                                                >
                                                                  <!-- Heroicon name: solid/sort-ascending -->
                                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-6=400"
                                                                      fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                    </svg>
                                                                  <span>Add</span>
                                                                </button>
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
                                                                                    border-gray-300 rounded-l-md">
                                                                              @foreach($publishers as $publisher)
                                                                                <option
                                                                                    value="{{$publisher->id}}">{{$publisher->name}}</option>
                                                                               @endforeach
                                                                            </select>
                                                                              <input x-show="newPublisher" type="text" name="publisher" id="publisher"
                                                                                 class="focus:ring-indigo-500
                                                                          focus:border-indigo-500 block w-full rounded-none rounded-l-md
                                                                          sm:text-sm border-gray-300" placeholder="E.g Oxford Publishing">
                                                                          @else
                                                                          <input type="text" name="publisher" id="publisher"
                                                                                 class="focus:ring-indigo-500
                                                                          focus:border-indigo-500 block w-full rounded-none rounded-l-md
                                                                          sm:text-sm border-gray-300" placeholder="E.g Oxford Publishing">
                                                                           @endif
                                                                    </div>
                                                                    <button x-bind:disabled="{{$publishers->count() === 0}}" @click.prevent="newPublisher = !newPublisher" class="-ml-px relative inline-flex  items-center space-x-2 px-4 py-2 border  text-sm font-medium rounded-r-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 "
                                                                            x-bind:class="newPublisher? 'border-emerald-300  text-emerald-700 bg-emerald-50 hover:bg-emerald-100 focus:ring-emerald-500 focus:border-emerald-500':'border-gray-300 text-gray-700 bg-gray-50 hover:bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500'"
                                                                        >
                                                                          <!-- Heroicon name: solid/sort-ascending -->
                                                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-6=400"
                                                                              fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                                            </svg>
                                                                          <span>Add</span>
                                                                        </button>
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
                                                                      <input type="date" name="publish_date" id="email"
                                                                            class="focus:ring-indigo-500
                                                                      focus:border-indigo-500 block w-full rounded-none rounded-md pl-10
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
                                        <button @click="showCreate = false;"
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

            <div>


                    <table class="table-auto">
                        <thead class="">
                        <tr>
                            <th class="">Id</th>
                            <th class="">Title</th>
                            <th class="">Author ID</th>
                            <th class="">Description</th>
                            <th class="">Edit</th>
                            <th class="">Delete</th>
                        </tr>
                        </thead>


                        @forelse($books as $book)
                        <tbody>
                        <tr class="bg-blue-200">
                            <td class="px-10">{{ $book -> id }}</td>
                            <td class="px-10">{{ $book -> title }}</td>
                            <td class="px-10">{{$book -> author_id}}</td>
                            <td class="px-10">{{$book -> description}}</td>
{{--                            <td class="px-10">--}}
{{--                                <img src="{{asset('images/'.$book->image)}}" width="150px" height="150px" alt="Image">--}}
{{--                            </td>--}}
{{--                            <td class="px-10"><a href="/editbook/{{$book->id}}" class="btn btn-primary">Edit</a></td>--}}
{{--                            <td class="px-10"><a href="/deletebook/{{$book->id}}" class="btn btn-danger">Delete</a></td>--}}
                        </tr>
                        </tbody>
                        @empty
                            <tr>
                                <td colspan="4">
                                    No record Found.
                                </td>
                            </tr>

                        @endforelse


                    </table>
            </div>
        </main>
    </div>
</x-app-layout>
