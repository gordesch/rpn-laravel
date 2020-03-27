<x-admin.layout title="Programmation" category="programmings">
  <x-slot name="titleInnerHTML">
    Semaine du {{ $week->start->isoFormat('dddd DD MMMM YYYY') }}
  </x-slot>

  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M0,1.99079514 C0,0.891309342 0.894513756,0 1.99406028,0 L16,0 L20,4 L20,18.0059397 C20,19.1072288 19.1017876,20 18.0092049,20 L1.99079514,20 C0.891309342,20 0,19.1017876 0,18.0092049 L0,1.99079514 Z M5,2 L15,2 L15,8 L5,8 L5,2 Z M11,3 L14,3 L14,7 L11,7 L11,3 Z" clip-rule="evenodd"></path>
      </svg>
      Sauvegarder
    </x-admin.layout.header.button-primary>
  </x-slot>

  <x-admin.weeks.submenu selected="tuning" :week="$week"></x-admin.weeks.submenu>

  <form id="form" method="POST" action="{{ route('admin.weeks.update', [$week]) }}">
    @method('PUT')
    @csrf
    <ul id="programmings"
        class="grid xl:grid-cols-3 sm:grid-cols-2 grids-cols-1 grid-flow-row col-gap-2 row-gap-4 focus:outline-none">
      @foreach($week->programmings as $programming)
        <li x-data="{ open: false, html: {{ $programming->custom_showings_infos ? 'true' : 'false' }} }"
            id="programming_{{ $programming->id }}"
            class="min-w-0 col-span-1 bg-white hover:bg-gray-50 shadow focus:outline-none focus:shadow-outline-indigo sm:rounded-md cursor-move">
          <div class="block ">
            <div class="flex items-center px-4 py-3 sm:px-5">
              <div class="min-w-0 flex-1 flex items-center">
                <x-admin.shows.poster :show="$programming->show"/>
                <div class="min-w-0 flex-1 pl-4">
                  <div>
                    <div class="sm:flex sm:items-center sm:justify-between">
                      <div class="flex truncate mr-3">
                        <h2 class="text-sm leading-5 font-medium text-indigo-600 truncate">
                          {{ $programming->show->title }}
                        </h2>
                      </div>
                      <div class="flex items-center flex-shrink-0 text-xs leading-5">
                        <div
                          class="flex-shrink-0 py-1 pl-2 pr-1 border border-gray-100 bg-gray-100 rounded-l-md text-gray-700 text-xs">
                          {{ $programming->showings_count > 1 ?  $programming->showings_count . ' séances' : $programming->showings_count . ' séance'}}
                        </div>
                        <button @click.prevent="open = !open; $nextTick(() => { $refs.html_input.focus(); });"
                                type="button"
                                class="flex items-center py-1 px-2 border border-gray-300 rounded-r-md shadow-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                          <span :class="{ 'bg-gray-200': !html, 'bg-indigo-600': html }"
                                class="relative inline-block flex-no-shrink mr-1 -mt-px mb-px h-3 w-5 border-2 border-transparent rounded-full transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline {{ $programming->custom_showings_infos ? 'bg-indigo-600' : 'bg-gray-200' }}">
                            <span aria-hidden="true" :class="{ 'translate-x-2': html, 'translate-x-0': !html }"
                                  class="inline-block h-2 w-2 rounded-full absolute top-0 left-0 bg-white shadow transform transition ease-in-out duration-200 {{ $programming->custom_showings_infos ? 'translate-x-2' : 'translate-x-0' }}"></span>
                          </span>
                          <span>
                            HTML
                          </span>
                        </button>
                      </div>
                    </div>
                    <div x-show="open === true" style="display: none;" @click.away="open = false"
                         @keydown.escape="open = false" class="flex my-px rounded-md shadow-sm">
                      <div class="relative flex-grow focus-within:z-10">
                        <input
                          x-ref="html_input"
                          class="form-input block w-full py-1 px-2 rounded-none rounded-l-md text-xs leading-5 transition ease-in-out duration-150"
                          type="text"
                          name="programming[{{ $programming->id }}][custom_showings_infos]"
                          id="programming_{{ $programming->id }}_custom_showings_infos"
                          placeholder="Avant-première<br />Dimanche à 18h"
                          value="{!! $programming->custom_showings_infos !!}"
                          size="60"
                          maxlength="255"
                          @input="html = ($refs.html_input.value.length > 0)"
                          autofocus
                        />
                      </div>
                      <button @click.prevent="open = !open"
                              class="-ml-px relative inline-flex items-center px-1 py-1 border border-gray-300 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <svg class="h-5 w-5 text-gray-400 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span class="sr-only">Close</span>
                      </button>
                    </div>
                    <div x-show="!open"
                         class="grid grid-rows-2 grid-cols-2 gap-2 md:flex md:justify-between md:items-center mt-2 text-xs font-medium leading-5">
                      <x-admin.programmings.checkbox label="VF" for="is_dubbed_version" :programming="$programming"/>
                      <x-admin.programmings.checkbox label="VO" for="is_original_version" :programming="$programming"/>
                      <x-admin.programmings.checkbox label="2D" for="is_2d" :programming="$programming"/>
                      <x-admin.programmings.checkbox label="3D" for="is_3d" :programming="$programming"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </form>

  <x-slot name="scripts">
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.9/lib/draggable.bundle.js"></script>
    <script>
      const sortable = new Draggable.Sortable(document.querySelectorAll('#programmings'), {
        draggable: 'li',
        distance: 3,
        classes: {
          'source:dragging': 'invisible',
          'mirror': 'border-gray-200'
        },
      });
      let change = false;
      document.forms['form'].addEventListener('change', () => change = true);
      sortable.on('sortable:sorted', () => change = true);
      window.addEventListener('beforeunload', function (e) {
        if(change) {
          e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
          let confirmationMessage = 'Vous avez effectué des modifications. Voulez-vous quitter la page sans sauvegarder ?';
          e.returnValue = confirmationMessage; // Gecko, Trident, Chrome 34+
          return confirmationMessage; // Gecko, WebKit, Chrome <34
        }
      });
    </script>
  </x-slot>
</x-admin.layout>
