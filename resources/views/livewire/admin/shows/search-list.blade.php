<div>
  <div class="mb-6 text-center">
    <x-admin.layout.header.button-primary-dropdown :href="route('admin.shows.import.search.create') . '?search=' . $search">
      <x-slot name="mainInnerHTML">
        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M11,9 L11,5 L9,5 L9,9 L5,9 L5,11 L9,11 L9,15 L11,15 L11,11 L15,11 L15,9 L11,9 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,14.418278 5.581722,18 10,18 Z" clip-rule="evenodd"></path>
        </svg>
        Importer une fiche
      </x-slot>

      <x-admin.layout.header.button-primary-dropdown-item route="admin.shows.create">
        Création manuelle
      </x-admin.layout.header.button-primary-dropdown-item>
    </x-admin.layout.header.button-primary-dropdown>
  </div>

  <div class="bg-white shadow overflow-hidden sm:rounded-md max-w-3xl mx-auto">
    <ul>
      <li>
        <a href="" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
          @if (!empty($search) && $shows->isEmpty())
            <div class="flex px-4 py-4 sm:px-6 text-center text-sm leading-5">
              Aucun résultat dans notre base de données.
            </div>
          @endif
        </a>
      </li>
      @foreach($shows as $show)
        <li class="border-t border-gray-200">
          <a href="{{ route('admin.shows.edit', [$show]) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
            <div class="flex items-center px-4 py-4 sm:px-6">
              <div class="min-w-0 flex-1 flex items-center">
                <x-admin.shows.poster :show="$show" />
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                  <div>
                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                      {{ $show->title }}
                    </div>
                    <div class="mt-2 flex items-center text-sm leading-5 @if ($show->year OR $show->release_date) text-gray-500 @else text-gray-400 @endif">
                      <svg class="flex-shrink-0 mr-1.5 h-5 w-5 @if ($show->year OR $show->release_date) text-gray-400 @else text-gray-300 @endif" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                      </svg>
                      @if ($show->year OR $show->release_date)
                        {{ $show->year ?? '' }}{{ $show->release_date ? ', sortie le ' . $show->release_date : '' }}
                      @else
                        Inconnu
                      @endif
                    </div>
                  </div>
                  <div class="hidden md:block">
                    <div>
                      <div class="flex items-center text-sm leading-5 @if ($show->director) text-gray-500 @else text-gray-400 @endif">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 @if ($show->director) text-gray-400 @else text-gray-300 @endif" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                        </svg>
                        @if ($show->director)
                          <span class="truncate">
                    De {{ $show->director }}
                  </span>
                        @else
                          Inconnu
                        @endif
                      </div>
                      <div class="mt-2 flex items-center text-sm leading-5 @if ($show->cast) text-gray-500 @else text-gray-400 @endif">
                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 @if ($show->cast) text-gray-400 @else text-gray-300 @endif" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" clip-rule="evenodd"/>
                        </svg>

                        @if ($show->cast)
                          <span class="truncate">
                    Avec {{ $show->cast }}
                  </span>
                        @else
                          Inconnu
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
              </div>
            </div>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
