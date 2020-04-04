@if ($paginator->hasPages())
  <ul class="relative z-0 inline-flex shadow-sm" role="navigation">
    {{-- Previous Page Link --}}
    <li class="">
      <button
        aria-label="Page précédente"
        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300  text-sm leading-5 font-medium text-gray-500 @if ($paginator->onFirstPage()) bg-gray-100 cursor-default @else bg-white hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 @endif transition ease-in-out duration-150"
        rel="prev"
        type="button"
        @if (! $paginator->onFirstPage())
          wire:click="previousPage"
        @else
          disabled
        @endif
      >
        <span class="block sm:block">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
          </svg>
        </span>
        <span class="hidden sm:block">
          Précédent
        </span>
      </button>
    </li>

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <li class="" aria-disabled="true">
          <button class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 cursor-default" disabled>
            {{ $element }}
          </button>
        </li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          <li class="hidden sm:block">
            <button
              type="button"
              class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium text-gray-700 @if ($page == $paginator->currentPage()) bg-gray-100 cursor-default @else bg-white hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 @endif transition ease-in-out duration-150"
              @if ($page == $paginator->currentPage())
                aria-current="page"
                disabled
              @else
                wire:click="gotoPage({{ $page }})"
              @endif
            >
              {{ $page }}
            </button>
          </li>
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    <li class="">
      <button
        type="button"
        class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 text-sm leading-5 font-medium text-gray-500 @if (! $paginator->hasMorePages()) bg-gray-100 cursor-default @else bg-white hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 @endif transition ease-in-out duration-150"
        @if ($paginator->hasMorePages())
          wire:click="nextPage"
        @else
          disabled
        @endif
        rel="next"
        aria-label="Page suivante">
        <span class="hidden sm:block">
          Suivant
        </span>
        <span class="block sm:block">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
        </span>
      </button>
    </li>
  </ul>
@endif
