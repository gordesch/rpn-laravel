@if ($paginator->hasPages())
  <button
    aria-label="Page précédente"
    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 @if ($paginator->onFirstPage()) bg-gray-100 cursor-default @else bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 @endif transition ease-in-out duration-150"
    rel="prev"
    type="button"
      wire:click="previousPage"

  >
    Précédent
  </button>

  <button
    aria-label="Page suivante"
    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 @if (!$paginator->hasMorePages()) bg-gray-100 cursor-default @else bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 @endif transition ease-in-out duration-150"
    rel="next"
    type="button"
    @if ($paginator->hasMorePages())
      wire:click="nextPage"
    @else
      disabled
    @endif
  >
    Suivant
  </button>
@endif
