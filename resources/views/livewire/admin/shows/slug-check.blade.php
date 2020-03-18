<div @if ($poll ?? false) wire:poll="check" @endif class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
  <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
    {{ $title }}
  </label>
  <div class="mt-1 sm:mt-0 sm:col-span-2">
    <div
      @if ($width === '4')
      class="w-16 rounded-md shadow-sm relative"
      @elseif ($width === '6')
      class="w-20 rounded-md shadow-sm relative"
      @elseif ($width === 'xs')
      class="max-w-xs rounded-md shadow-sm relative"
      @elseif ($width === 'sm')
      class="max-w-sm rounded-md shadow-sm relative"
      @elseif ($width === 'md')
      class="max-w-md rounded-md shadow-sm relative"
      @elseif ($width === 'lg')
      class="max-w-lg rounded-md shadow-sm relative"
      @endif
    >
      <input
        wire:model="value"
        wire:loading.class.remove="border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red border-green-300 text-green-900 placeholder-green-300 focus:border-green-300 focus:shadow-outline-green"
        wire:target="value"
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($state === 'error')
        class="form-input block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red sm:text-sm sm:leading-5"
        @elseif ($value !== $except)
        class="form-input block w-full pr-10 border-green-300 text-green-900 placeholder-green-300 focus:border-green-300 focus:shadow-outline-green sm:text-sm sm:leading-5"
        @else
        class="form-input block w-full pr-10 sm:text-sm sm:leading-5"
        @endif
        value="{{ old($name, $value) }}"
        type="text"
        x-ref="slugcheck"
        data-valid="{{ $state === 'error' ? 'false' : 'true' }}"
      />
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        @if ($state === 'error')
          <svg wire:loading.class="hidden" wire:target="value" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
        @elseif ($value !== $except)
          <svg wire:loading.class="hidden" wire:target="value" class="h-5 w-5  text-green-400 " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        @endif
        <span wire:loading wire:target="value" class="h-5 w-5 spinner text-gray-400"></span>
      </div>
    </div>
    @if (!$shouldExist && $value === $except)
      <p wire:loading.class="invisible" wire:target="value" class="mt-2 text-sm text-gray-500">
        Aucune modification pour l'instant.
      </p>
    @elseif ($state === 'success' && $shouldExist)
      <p wire:loading.class="invisible" wire:target="value" class="mt-2 text-sm text-green-500">Correspondance trouvée.</p>
    @elseif ($state === 'success' && !$shouldExist)
      <p wire:loading.class="invisible" wire:target="value" class="mt-2 text-sm text-green-500">Ce titre simplifié est disponible.</p>
    @elseif ($state === 'error' && $shouldExist)
      <p wire:loading.class="invisible" wire:target="value" class="mt-2 text-sm text-red-500">
        Aucune correspondance trouvée.
        <a
          href="{{ route('admin.shows.import.search.create') }}?search={{ $title }}&ticketing_provider_id={{ $ticketingProviderId }}"
          class="inline rounded-md shadow-sm px-2.5 py-1.5 border border-gray-300 text-xs leading-4 font-medium rounded text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
          target="_blank"
        >
          Importer ce film ?
        </a>
      </p>
    @elseif ($state === 'error' && !$shouldExist)
      <p wire:loading.class="invisible" wire:target="value" class="mt-2 text-sm text-red-500">Ce titre simplifié n'est pas disponible.</p>
    @endif
  </div>
</div>
