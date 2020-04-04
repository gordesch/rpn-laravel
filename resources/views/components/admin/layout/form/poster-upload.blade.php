<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
  <label for="poster" class="block text-sm leading-5 font-medium text-gray-700">
    Affiche
  </label>
  <div class="mt-2 sm:mt-0 sm:col-span-2">
    <div class="flex items-center">
      <livewire:admin.shows.poster :show="$show" :poll="$show->poster_is_pending" :key="$show->id" />
      <div x-data="{ open: false }" class="ml-5 rounded-md shadow-sm">
        <button @click.prevent="open = !open"  x-show="open === false" type="button" class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
          Nouvelle affiche
        </button>
        <div x-show="open === true" style="display: none;" class="flex rounded-md shadow-sm">
          <div class="relative flex-grow focus-within:z-10">
            <input
              id="poster_url"
              name="poster_url"
              class="form-input block w-full rounded-none rounded-l-md transition ease-in-out duration-150 sm:text-sm sm:leading-5"
              placeholder="http://allocine.fr/images/film.jpg"
              size="50"
              value="{{ old('poster_url', ($show->exists ? null : $show->poster_url)) }}"
            />
          </div>
          <button @click.prevent="open = !open" class="-ml-px relative inline-flex items-center px-2 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            <svg class="h-5 w-5 text-gray-400 "fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span class="sr-only">Close</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
