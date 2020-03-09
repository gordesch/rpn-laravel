@props(['mainInnerHTML', 'href'])
<span class="ml-3 rounded-md">
  <span class="relative z-0 inline-flex">
    <a href="{{ $href }}" class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-transparent text-sm leading-5 font-medium text-white bg-indigo-600 hover:bg-indigo-500 focus:z-10 focus:outline-none focus:shadow-outline transition ease-in-out duration-150 shadow-sm">
      {!! $mainInnerHTML !!}
    </a>
    <span x-data="{ open: false }" class="ml-px relative block">
      <button @click="open = !open" @click.away="open = false" type="button" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-transparent  text-sm leading-5 font-medium text-white bg-indigo-600 hover:bg-indigo-500 focus:z-10 focus:outline-none focus:shadow-outline transition ease-in-out duration-150 shadow-sm">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </button>
      <div x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 -mr-1 w-56 rounded-md shadow-lg">
        {{ $slot }}
      </div>
    </span>
  </span>
</span>
