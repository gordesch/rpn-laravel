<div @if ($poll ?? false) wire:poll="check" @endif class="flex-shrink-0">
  @if($show->poster_is_pending)
    <div class="flex justify-center align-items-center h-12 w-9 border border-gray-300 rounded-sm shadow-inner bg-gray-50 text-gray-300 spinner">
    </div>
  @elseif (!empty($show->poster_url || $show->getFirstMediaUrl('posters', 'sm')))
    <img
      class="h-12 w-9 border border-gray-300 rounded-sm shadow-inner bg-gray-50 text-gray-300"
      src="{{ $show->poster_url ? Str::replaceFirst('http://', 'https://', $show->poster_url) : $show->getFirstMediaUrl('posters', 'sm') }}"
      srcset="
          {{ $show->poster_url ? Str::replaceFirst('http://', 'https://', $show->poster_url) : $show->getFirstMediaUrl('posters', 'sm')  }} 1x,
          {{ $show->poster_url ? Str::replaceFirst('http://', 'https://', $show->poster_url) : $show->getFirstMediaUrl('posters', 'sm@2x')  }} 2x
        "
      alt=""
    />

  @else
    <a
      href="{{ route('admin.shows.edit', [$show]) }}"
      class="flex justify-center items-center h-12 w-9 border border-gray-300 rounded-sm shadow-inner bg-gray-50 text-gray-300 opacity-50 hover:opacity-75 focus:shadow-outline-indigo focus:opacity-100"
    >
        <svg class="h-4 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM8.70711 7.29289C8.31658 6.90237 7.68342 6.90237 7.29289 7.29289C6.90237 7.68342 6.90237 8.31658 7.29289 8.70711L8.58579 10L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071C7.68342 13.0976 8.31658 13.0976 8.70711 12.7071L10 11.4142L11.2929 12.7071C11.6834 13.0976 12.3166 13.0976 12.7071 12.7071C13.0976 12.3166 13.0976 11.6834 12.7071 11.2929L11.4142 10L12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289C12.3166 6.90237 11.6834 6.90237 11.2929 7.29289L10 8.58579L8.70711 7.29289Z" clip-rule="evenodd"></path>
        </svg>
    </a>
  @endif
</div>
