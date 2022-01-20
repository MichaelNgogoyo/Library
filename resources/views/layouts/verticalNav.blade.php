 <div class="flex flex-col h-0 flex-1">
    <div class="flex items-center h-16 flex-shrink-0 px-4 bg-gray-900">
       <a href="{{ route('dashboard') }}">
           <x-application-logo class="block h-10 w-auto fill-current text-white" />
        </a>
        <h1 class="text-white ml-2 text-3xl font-bold">Labrary</h1>
    </div>
    <div class="flex-1 flex flex-col overflow-y-auto">
      <nav class="flex-1 px-2 py-4 bg-gray-800 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="{{auth()->user()->hasRole('librarian')? route('dashboard'):'/student/dashboard'}}" class="text-white group flex
        items-center px-2
        py-2 text-sm
        font-medium
        rounded-md" :class="{'bg-gray-900':{{request()->routeIs('dashboard')}} }">
          <svg class="text-gray-300 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Dashboard
        </a>
        @php
            $menus = auth()->user()->hasRole('librarian') ? $menus->admin : $menus->student;
        @endphp
       @foreach($menus as $menu)
            <a href="{{route($menu->route)}}" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2
            text-sm
            font-medium
            rounded-md" :class="{'bg-gray-900':{{request()->routeIs($menu->route)}}}">
              <!-- Heroicon name: outline/users -->
              <i class="text-gray-400 group-hover:text-gray-300 mr-3 flex-shrink-0 text-2xl {{$menu->icon}}"></i>
                {{$menu->name}}
            </a>
        @endforeach

      </nav>
    </div>
  </div>
