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
    <div>
        <div class="flex"  x-data="{showDelete:false, showEdit:false, deleteLib:null, editingLibrary:null}" class="bg-white shadow
                        overflow-hidden sm:rounded-md">
            <div>
                <a href="#" class="mr-5" title="Edit book"
                    @click.prevent="showEdit = true; ">
                    <i class="far fa-edit text-gray-600"></i>
                </a>

                <a href="#" title="Delete book"
                    @click.prevent="showDelete = true;">
                    <i class="far fa-trash-alt text-red-600 "></i>
                </a>
            </div>
            <div>
                <div>
{{--                    Edit model--}}
                    <div x-show="showEdit" class="fixed z-10 inset-0 overflow-y-auto"
                         aria-labelledby="modal-title" role="dialog"
                         aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!--
                              Background overlay, show/hide based on modal state.

                              Entering: "ease-out duration-300"
                                From: "opacity-0"
                                To: "opacity-100"
                              Leaving: "ease-in duration-200"
                                From: "opacity-100"
                                To: "opacity-0"
                            -->
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

                            <!--
                              Modal panel, show/hide based on modal state.

                              Entering: "ease-out duration-300"
                                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                To: "opacity-100 translate-y-0 sm:scale-100"
                              Leaving: "ease-in duration-200"
                                From: "opacity-100 translate-y-0 sm:scale-100"
                                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            -->
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
                                <form method="POST" :action="`update/library/${editingLibrary.id}`">
                                    @csrf
                                    @method('PUT')
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full
                                                bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-6 w-6 text-indigo-600" fill="none"
                                                 viewBox="0 0
                                                    24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                id="modal-title">
                                                Edit Library
                                            </h3>
                                            <div class="mt-2">
                                                <div class="space-y-8 divide-y divide-gray-200">
                                                    <div>
                                                        <div class="sm:col-span-4">
                                                            <label for="email"
                                                                   class="block text-sm font-medium text-gray-700">
                                                                Library Name
                                                            </label>
                                                            <div class="mt-1">
                                                                <input :value="editingLibrary.name"
                                                                       id="library-name" name="name"
                                                                       type="text"
                                                                       autocomplete="name"
                                                                       class="shadow-sm
                                                                focus:ring-gray-500 focus:border-gray-500 block w-full sm:text-sm border-gray-300 rounded-md">
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
                                        <button @click.prevent="showEdit = false; editingLibrary = null"
                                                type="button" class="mt-3
                                        w-full inline-flex justify-center rounded-md border
                                        border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
{{--                    Delete model--}}
                    <div x-show="showDelete" class="fixed z-10 inset-0 overflow-y-auto"
                         aria-labelledby="modal-title" role="dialog"
                         aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <!--
                              Background overlay, show/hide based on modal state.

                              Entering: "ease-out duration-300"
                                From: "opacity-0"
                                To: "opacity-100"
                              Leaving: "ease-in duration-200"
                                From: "opacity-100"
                                To: "opacity-0"
                            -->
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

                            <!--
                              Modal panel, show/hide based on modal state.

                              Entering: "ease-out duration-300"
                                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                To: "opacity-100 translate-y-0 sm:scale-100"
                              Leaving: "ease-in duration-200"
                                From: "opacity-100 translate-y-0 sm:scale-100"
                                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            -->
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
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Are you sure you want to delete book: <strong
                                                    x-text="deleteLib.name" class="underline
                                              decoration-red-500 decoration-2 underline-offset-1"></strong>? <strong>
                                                    All data associated will be permanently removed from our
                                                    servers forever
                                                </strong>. This action cannot be
                                                undone.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <form method="POST" :action="`delete/library/${deleteLib.id}`">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex
                                            justify-center rounded-md border
                                            border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                            Delete
                                        </button>
                                    </form>
                                    <button @click.prevent="showDelete = false; deleteLib = null"
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
    </div>

</x-livewire-tables::table.cell>

