<x-app-layout>
    <x-slot name="header">
        {{ __('Student Dashboard') }}
    </x-slot>

    <div class="py-6">
        <div class="mx-auto">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Summary
              </h3>
              <dl class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
                <div class="px-4 py-5 sm:p-6">
                  <dt class="text-base font-normal text-gray-900">
                    Total Books
                  </dt>
                  <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                        {{auth()->user()->borrowings->count()}}
                      <span class="ml-2 text-sm font-medium text-gray-500">
                        books borrowed
                      </span>
                    </div>

                    <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                      <!-- Heroicon name: solid/arrow-sm-up -->
                      <svg class="-ml-1 mr-0.5 flex-shrink-0 self-center h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                      </svg>
                      <span class="sr-only">
                        Increased by
                      </span>
                      12%
                    </div>
                  </dd>
                </div>

                <div class="px-4 py-5 sm:p-6">
                  <dt class="text-base font-normal text-gray-900">
                    Approved Requests
                  </dt>
                  <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                      {{auth()->user()->borrowings->where('approved', 1)->count()}}
                      <span class="ml-2 text-sm font-medium text-gray-500">
                        approved requests
                      </span>
                    </div>

                    <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">

                        <i class="fad fa-check text-green-500"></i>
                      <span class="sr-only">
                        value
                      </span>
                        {{ (auth()->user()->borrowings->where('approved', 1)->count()/auth()->user()->borrowings->count())*100 }}%
                    </div>
                  </dd>
                </div>

                <div class="px-4 py-5 sm:p-6">
                  <dt class="text-base font-normal text-gray-900">
                    Rejected Requests
                  </dt>
                  <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                      {{auth()->user()->borrowings->where('approved', 0)->count()}}
                      <span class="ml-2 text-sm font-medium text-gray-500">
                        rejected requests
                      </span>
                    </div>

                    <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800 md:mt-2 lg:mt-0">
                      <i class="fad fa-close pr-1 text-red-500"></i>
                      <span class="sr-only">
                        rejected percentage
                      </span>
                      {{ (auth()->user()->borrowings->where('approved', 0)->count()/auth()->user()->borrowings->count())*100 }}%
                    </div>
                  </dd>
                </div>
              </dl>
            </div>

        </div>
    </div>

       <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-12" x-data="{showCreate: false, newAuthor:false, newPublisher:false}">
        <h1 class="text-base text-2xl text-gray-700">Books Lent
           <button @click="showCreate = !showCreate" class="inline-flex w-[max-content]  ml-5 items-center px-2.5 py-1.5 border
           border-transparent text-xs font-medium rounded text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2
           focus:ring-offset-2 focus:ring-gray-700">
             <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
              </svg>
              Lend Book
            </button>
        </h1>
        <main class="flex-1 flex mt-6">
            <livewire:borrowing-table :user="auth()->id()"/>
{{--            @livewire('borrowing-table', ['user'=>auth()->id()])--}}
             {{-- Update modal--}}
              <div x-show="showCreate" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"             aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" x-show="showCreate"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-100"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"></div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                              aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 min-w-[44vw] max-h-[80vh] overflow-auto"
                            x-show="showCreate"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <form method="POST" action="{{route('student.store.borrowings')}}">
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
                                            Lend a book
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
                                                          </div>
                                                        </div>

                                                       <div class="sm:col-span-4 md:col-span-4">
                                                          <label for="title" class="block text-sm font-medium text-gray-700">
                                                            Lending Date
                                                          </label>
                                                          <div class="mt-1">
                                                           <div class="relative flex items-stretch flex-grow focus-within:z-10">
                                                              <input type="date" :min="new Date().toISOString().split('T')[0]"
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
                                                                  <input type="date" :min="new Date().toISOString().split('T')[0]"  name="return_date" id="return_date"
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
        </main>
    </div>
</x-app-layout>
