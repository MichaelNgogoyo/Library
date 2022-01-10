<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Books') }}
        </h2>
    </x-slot>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="mt-12" x-data="{showCreate: false, newAuthor:false, newPublisher:false}">
        <button>
            Edit book
        </button>
            <div>
                <form action="/updatebook/{{$books->id}}" method="POST" enctype="multipart/form-data" class="w-full max-w-sm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>
                            Title
                        </label>
                        <input type="text" name="title" class="form-control" value="{{ $books -> title }}" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label>
                            Author
                        </label>
                        <input type="text" name="author" class="form-control" value="{{ $books -> author }}" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label>
                            Copies
                        </label>
                        <input type="text" name="copies" class="form-control" value="{{ $books -> copies }}" placeholder="Title">
                    </div>


                    <div class="py-2">
                        <button type="submit" name="submit" class="btn btn-primary"> Save Data</button>
                    </div>
                </form>
            </div>


    </div>
</x-app-layout>
