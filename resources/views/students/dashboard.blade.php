<x-app-layout>
    <x-slot name="header">
        {{ __('Student Dashboard') }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <i class="fad fa-books"></i>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
