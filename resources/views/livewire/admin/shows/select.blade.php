<div
  x-data="{ open: false, focusInResults: null }"
  @keydown.away.escape="open = false"
  @click.away="open = false"
  class="relative"
>
  @if (is_null($selected))
    <div class="relative max-w-lg w-full lg:max-w-xs">
      <div class="absolute inset-y-0 left-0 w-12 pl-3 flex items-center justify-center pointer-events-none">
        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <label for="search" class="sr-only">Rechercher</label>
      <input
        id="search"
        @focus="open = true"
        @keydown.arrow-down.prevent="document.getElementById('suggestion1').focus()"
        wire:model.debounce.500ms="search"
        class="block w-full h-16 pl-16 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out shadow-sm"
        placeholder="Rechercher..."
        size="50"
        autocomplete="off"
      />
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <span
          wire:loading
          wire:target="search"
          @if ($resultsLoading) style="display:inline-block" @endif
          class="h-5 w-5 text-gray-400 spinner"
        >
        </span>
      </div>
    </div>
  @else
    <div class="flex items-center max-w-lg w-full lg:max-w-xs h-16 py-2 px-3 border border-gray-300 rounded-md rounded-r-none leading-5 bg-white shadow-sm">
      <div class="flex-shrink-0 flex items-center">
        <livewire:admin.shows.poster :show="$selected" />
      </div>
      <div class="flex-grow ml-4 mt-px sm:text-sm pointer-events-none">
        {{ $selected->title }}
        @if (! is_null($selected->year))
          <span class="text-gray-400 text-xs">
            {{ $selected->year }}
          </span>
        @endif
      </div>
      <button wire:click.prevent="unselect" class="flex-shrink-0 flex items-center">
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM8.70711 7.29289C8.31658 6.90237 7.68342 6.90237 7.29289 7.29289C6.90237 7.68342 6.90237 8.31658 7.29289 8.70711L8.58579 10L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071C7.68342 13.0976 8.31658 13.0976 8.70711 12.7071L10 11.4142L11.2929 12.7071C11.6834 13.0976 12.3166 13.0976 12.7071 12.7071C13.0976 12.3166 13.0976 11.6834 12.7071 11.2929L11.4142 10L12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289C12.3166 6.90237 11.6834 6.90237 11.2929 7.29289L10 8.58579L8.70711 7.29289Z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  @endif
  @if (is_null($selected) && $search !== '')
    <div
      x-show="open"
      x-transition:enter="transition ease-out duration-100"
      x-transition:enter-start="transform opacity-0 scale-95"
      x-transition:enter-end="transform opacity-100 scale-100"
      x-transition:leave="transition ease-in duration-75"
      x-transition:leave-start="transform opacity-100 scale-100"
      x-transition:leave-end="transform opacity-0 scale-95"
      class="max-w-lg w-full lg:max-w-xs origin-top-right absolute inset-x-0 mt-2 rounded-md shadow-lg z-10 select-for-{{ $search }}"
    >
      <div class="rounded-md bg-white shadow-xs">
        @if (count($shows) > 0)
          <div class="py-1">
            @foreach ($shows as $show)
              <button
                wire:key="{{ $show->id }}"
                wire:click.prevent="select({{ $show->id }})"
                class="flex items-center h-16 w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                tabindex="-1"
                id="suggestion{{ $loop->iteration }}"
                data-iteration="{{ $loop->iteration }}"
                @if (! $loop->first)
                  x-on:keydown.arrow-up.prevent="document.getElementById('suggestion{{ $loop->iteration - 1 }}').focus()"
                @else
                  x-on:keydown.arrow-up.prevent="document.getElementById('search').focus()"
                @endif
                @if ($loop->last)
                  data-last-iteration="true"
                  x-on:keydown.arrow-down.prevent="document.querySelector('.select-for-{{ $search }} [data-import-link]').focus()"
                @else
                  x-on:keydown.arrow-down.prevent="document.getElementById('suggestion{{ $loop->iteration + 1 }}').focus()"
                @endif
                x-on:keydown.escape="document.getElementById('search').focus()"
              >
                <div class="flex-shrink-0 pl-3 flex items-center">
                  <livewire:admin.shows.poster :show="$show" :key="$show->id" />
                </div>
                <div class="flex-grow ml-4 text-left sm:text-sm">
                  {{ $show->title }}
                  @if (! is_null($show->year))
                    <span class="text-gray-400 text-xs">
                      {{ $show->year }}
                    </span>
                  @endif
                </div>
              </button>
            @endforeach
          </div>
          <div class="border-t border-gray-100"></div>
        @endif
        <div class="py-1">
          <a
            wire:key="{{ $search }}"
            tabindex="-1"
            data-import-link="true"
            x-on:keydown.arrow-up.prevent="document.querySelector('.select-for-{{ $search }} [data-last-iteration]').focus()"
            x-on:keydown.escape="document.getElementById('search').focus()"
            href="{{ route('admin.shows.import.search.create') }}?search={{ $search }}&ticketing_provider_id={{ optional($show ?? null)->ticketing_provider_id }}"
            class="flex items-center justify-center w-full px-4 py-2 leading-5 text-xs text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700"
            target="_blank"
          >
            <span>Importer un film ?</span>
          </a>
        </div>
      </div>
    </div>
  @endif
</div>
