<tr
  @if (!$show->ignore_missing_data && (!$show->duration_in_seconds || !$show->genre || !$show->synopsis || !$show->videos_count))
  class="bg-red-50"
  @elseif (!$show->ignore_missing_data && (!$show->country || !$show->year || !$show->director || !$show->cast))
  class="bg-yellow-50"
  @endif
>
  <td class="max-w-xs px-6 py-4 whitespace-no-wrap border-b border-gray-200">
    <div class="flex items-center">
      <livewire:admin.shows.poster :show="$show" :poll="$show->poster_is_pending" :key="$show->id" />
      <h4 class="block ml-5 text-sm font-medium leading-5 text-gray-700 truncate">
        {{ $show->title }}
      </h4>
    </div>
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->genre)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing-important :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->duration_in_seconds)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing-important :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->country)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->year)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->director)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->cast)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->synopsis)
      <x-admin.weeks.shows-state.valid />
    @else
      <x-admin.weeks.shows-state.missing-important :href="route('admin.shows.edit', [$show])" :ignoreMissingData="$show->ignore_missing_data"/>
    @endif
  </td>
  <td class="whitespace-no-wrap border-b border-gray-200">
    @if ($show->videos_count)
      <x-admin.weeks.shows-state.valid />
    @else
      <a
        x-data=""
        x-on:click.prevent="document.dispatchEvent(new CustomEvent('edit-videos', { detail: { src: '{{ route('admin.shows.videos.edit', [$show]) }}' } } ));"
        type="button"
        class="group block px-6 py-4"
        href="{{ route('admin.shows.videos.edit', [$show]) }}"
        >
        <x-admin.weeks.shows-state.missing-important :ignoreMissingData="$show->ignore_missing_data" />
      </a>

    @endif
  </td>
  <td class="whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium">
    @if ($show->shows_provider_id)
      <button
        wire:click.prevent="sync"
        type="button"
        @if (!$show->ignore_missing_data && (!$show->duration_in_seconds || !$show->genre || !$show->synopsis || !$show->country || !$show->year || !$show->director || !$show->cast))
          class="inline-flex items-center mr-2 px-3 py-2 border border-transparent text-xs leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150"
        @else
          class="inline-flex items-center mr-2 px-3 py-2 border border-gray-300 text-xs leading-4 font-medium rounded-md shadow-sm text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
        @endif
      >
        <svg class="-ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10,3 C6.13400675,3 3,6.13400675 3,10 C3,11.9329966 3.78350169,13.6829966 5.05025253,14.9497475 L6.46446609,13.5355339 C5.55964406,12.6307119 5,11.3807119 5,10 C5,7.23857625 7.23857625,5 10,5 L10,3 L10,3 Z M14.9497475,5.05025253 C16.2164983,6.31700338 17,8.06700338 17,10 C17,13.8659932 13.8659932,17 10,17 L10,15 C12.7614237,15 15,12.7614237 15,10 C15,8.61928813 14.4403559,7.36928813 13.5355339,6.46446609 L14.9497475,5.05025253 L14.9497475,5.05025253 Z M10,20 L6,16 L10,12 L10,20 L10,20 Z M10,8 L14,4 L10,0 L10,8 L10,8 Z" clip-rule="evenodd"></path>
        </svg>
        Sync
      </button>
    @endif
  </td>
  <td class="whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium">
    <button wire:click.prevent="toggleIgnoreMissing" type="button" class="inline-flex items-center mr-4 px-3 py-2 border border-gray-300 text-xs leading-4 font-medium rounded-md shadow-sm bg-white @if (!$show->ignore_missing_data) text-gray-500 hover:text-gray-400 @else text-gray-700 hover:text-gray-500 @endif focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-600 active:bg-gray-50 transition ease-in-out duration-150">
      <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
        @if ($show->ignore_missing_data)
          <path fill-rule="evenodd" d="M14,8 C14,5.790861 12.209139,4 10,4 C7.790861,4 6,5.790861 6,8 L6,15 L14,15 L14,8 Z M8.02739671,2.33180314 C5.68271203,3.14769073 4,5.37733614 4,8 L4,14 L1,16 L1,17 L19,17 L19,16 L16,14 L16,8 C16,5.37733614 14.317288,3.14769073 11.9726033,2.33180314 C11.9906226,2.22388264 12,2.11303643 12,2 C12,0.8954305 11.1045695,0 10,0 C8.8954305,0 8,0.8954305 8,2 C8,2.11303643 8.0093774,2.22388264 8.02739671,2.33180314 L8.02739671,2.33180314 Z M12,18 C12,19.1045695 11.1045695,20 10,20 C8.8954305,20 8,19.1045695 8,18 L12,18 L12,18 Z" clip-rule="evenodd"></path>
        @else
          <path fill-rule="evenodd" d="M8.02739671,2.33180314 C5.68271203,3.14769073 4,5.37733614 4,8 L4,14 L1,16 L1,17 L19,17 L19,16 L16,14 L16,8 C16,5.37733614 14.317288,3.14769073 11.9726033,2.33180314 C11.9906226,2.22388264 12,2.11303643 12,2 C12,0.8954305 11.1045695,0 10,0 C8.8954305,0 8,0.8954305 8,2 C8,2.11303643 8.0093774,2.22388264 8.02739671,2.33180314 L8.02739671,2.33180314 Z M12,18 C12,19.1045695 11.1045695,20 10,20 C8.8954305,20 8,19.1045695 8,18 L12,18 L12,18 Z" clip-rule="evenodd"></path>
        @endif
      </svg>
    </button>
  </td>
</tr>
