<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Library') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/fontawesome/css/all.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            [x-cloak] { display: none !important; }
        </style>
         @livewireStyles
         @livewireScripts
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div x-data="{open: false}"  x-init="setTimeout(() => open = false, 3000)" class="h-screen flex overflow-hidden bg-gray-100">
            @include('layouts.mobilenav')
          </div>

          <!-- Static sidebar for desktop -->
          <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
              <!-- Sidebar component, swap this element with another sidebar if you like -->
             @include('layouts.verticalNav')
            </div>
          </div>
          <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
              <button x-on:click="open = !open" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2
              focus:ring-inset
              focus:ring-indigo-500 md:hidden">
                <span class="sr-only">Open sidebar</span>
                <!-- Heroicon name: outline/menu-alt-2 -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
              </button>
              <div class="flex-1 px-4 flex justify-between">
                <div class="flex-1 flex">
                  <form class="w-full flex md:ml-0" action="#" method="GET">
                    <label for="search_field" class="sr-only">Search</label>
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                      <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                        <!-- Heroicon name: solid/search -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <input id="search_field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Search" type="search" name="search">
                    </div>
                  </form>
                </div>

                  {{--chat module--}}

                <div class="ml-4 flex items-center md:ml-6">
                    <div class="pr-4">
                        <a href="/messenger"><i class="fad fa-comments-alt text-2xl text-gray-500"></i></a>

                    </div>
                  <button class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="sr-only">View notifications</span>
                    <!-- Heroicon name: outline/bell -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                  </button>


                  <!-- Profile dropdown -->
                  @include('layouts.navigation')
                </div>
              </div>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                 @if(session('message'))
                    <div
                        class="px-4 py-4 leading-normal text-red-600 bg-red-100 rounded-lg"
                        role="alert">
                        <p class="font-bold">
                            {{ session('message') }}
                        </p>
                    </div>
                @endif
                    @if(session('success'))
                        <div class="rounded-md bg-green-50 p-4 m-0 m-auto w-[50%] mt-2 shadow-lg"
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
                              <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                              </svg>
                            </div>
                            <div class="ml-3">
                              <p class="text-sm font-medium text-green-800">
                                  {{ session('success') }}
                              </p>
                            </div>
{{--                            <div class="ml-auto pl-3">--}}
{{--                              <div class="-mx-1.5 -my-1.5">--}}
{{--                                <button type="button" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">--}}
{{--                                  <span class="sr-only">Dismiss</span>--}}
{{--                                  <!-- Heroicon name: solid/x -->--}}
{{--                                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                  </svg>--}}
{{--                                </button>--}}
{{--                              </div>--}}
{{--                            </div>--}}
                          </div>
                        </div>

                    @endif
                    @if(session('edit-alert'))
                        <div
                            class="px-4 py-4 leading-normal text-green-600 bg-indigo-50 rounded-lg"
                            role="alert">
                            <p class="font-bold">
                                {{ session('edit-alert') }}
                            </p>
                        </div>
                    @endif
              <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                  <h1 class="text-2xl font-semibold text-gray-900"> {{ $header }}</h1>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                  <!-- Replace with your content -->
                  {{$slot}}
                  <!-- /End replace -->
                </div>
              </div>
            </main>
          </div>
        </div>
    </body>
</html>
