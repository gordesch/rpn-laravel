<div>
  <div class="bg-white shadow overflow-hidden sm:rounded-md max-w-3xl mx-auto">
    <ul>
      @if ($weeks->isEmpty())
        <li>
          <a href=""
             class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
              <div class="flex px-4 py-4 sm:px-6 text-center text-sm leading-5">
                Aucune programmation importée.
              </div>
          </a>
        </li>
      @endif
      @foreach($weeks as $week)
        <li @if (!$loop->first) class="border-t border-gray-200" @endif>
          <a href="{{ route('admin.weeks.edit', [$week]) }}"
             class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
            <div class="flex items-center px-4 py-4 sm:px-6">
              <div class="min-w-0 flex-1 flex items-center">
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-4">
                  <div class="md:col-span-2">
                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                      Semaine du {{ $week->start->isoFormat('dddd DD MMMM YYYY') }}
                      <span class="ml-2 text-xs text-gray-500">
                        S{{ $week->start->isoFormat('WW') }}
                      </span>
                    </div>
                    <div class="mt-2 flex items-center text-sm leading-5 text-gray-500">
                      <div class="sm:flex">
                        <div class="mr-6 flex items-center text-sm leading-5 text-gray-500">
                          <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M0,3.99406028 C0,2.8927712 0.898212381,2 1.99079514,2 L18.0092049,2 C19.1086907,2 20,2.89451376 20,3.99406028 L20,16.0059397 C20,17.1072288 19.1017876,18 18.0092049,18 L1.99079514,18 C0.891309342,18 0,17.1054862 0,16.0059397 L0,3.99406028 Z M6,4 L14,4 L14,16 L6,16 L6,4 Z M2,5 L4,5 L4,7 L2,7 L2,5 Z M2,9 L4,9 L4,11 L2,11 L2,9 Z M2,13 L4,13 L4,15 L2,15 L2,13 Z M16,5 L18,5 L18,7 L16,7 L16,5 Z M16,9 L18,9 L18,11 L16,11 L16,9 Z M16,13 L18,13 L18,15 L16,15 L16,13 Z M8,7 L13,10 L8,13 L8,7 Z"
                                  clip-rule="evenodd"/>
                          </svg>
                          {{ $week->programmings_count > 1 ? $week->programmings_count . ' films' : $week->programmings_count . ' film' }}
                          @if ($week->shows_with_missing_data->count())
                            <span class="inline-flex items-center ml-1 px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-200 text-red-500 ">
                              <svg class="h-4 w-4 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.25706 3.09882C9.02167 1.73952 10.9788 1.73952 11.7434 3.09882L17.3237 13.0194C18.0736 14.3526 17.1102 15.9999 15.5805 15.9999H4.4199C2.89025 15.9999 1.92682 14.3526 2.67675 13.0194L8.25706 3.09882ZM11.0001 13C11.0001 13.5523 10.5524 14 10.0001 14C9.44784 14 9.00012 13.5523 9.00012 13C9.00012 12.4477 9.44784 12 10.0001 12C10.5524 12 11.0001 12.4477 11.0001 13ZM10.0001 5C9.44784 5 9.00012 5.44772 9.00012 6V9C9.00012 9.55228 9.44784 10 10.0001 10C10.5524 10 11.0001 9.55228 11.0001 9V6C11.0001 5.44772 10.5524 5 10.0001 5Z" clip-rule="evenodd"></path>
                              </svg>
                              dont {{ $week->shows_with_missing_data->count() }} à corriger
                            </span>
                          @endif
                        </div>
                        <div class="mt-2 flex items-center text-sm leading-5 text-gray-500 sm:mt-0">
                          <svg
                            class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M20,12 L20,17 L0,17 L0,12 C1.1045695,12 2,11.1045695 2,10 C2,8.8954305 1.1045695,8 0,8 L0,3 L20,3 L20,8 C18.8954305,8 18,8.8954305 18,10 C18,11.1045695 18.8954305,12 20,12 Z M3,5 L17,5 L17,15 L3,15 L3,5 Z M10,12.0831427 L7.07572273,14.118034 L8.10736797,10.7080651 L5.26841999,8.55572809 L8.83028908,8.48314266 L10,5.11803399 L11.1697109,8.48314266 L14.73158,8.55572809 L11.892632,10.7080651 L12.9242773,14.118034 L10,12.0831427 Z"
                                  clip-rule="evenodd"/>
                          </svg>
                          {{ $week->showings_count > 1 ? $week->showings_count . ' séances' : $week->showings_count . ' séance' }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="hidden md:block">
                    <div>
                      <div
                        class="flex items-center justify-end text-sm leading-5 text-gray-500">
                        @if ($week->programmings->first()->position !== null)
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Programmation réglée
                          </span>
                        @elseif (
                            $week->programmings->first()->position === null
                            && (
                                $week->start == \Gordesch\CineCarbon::now()->startOfWeek()
                                || $week->start == \Gordesch\CineCarbon::now()->addWeek()->startOfWeek()
                            )
                        )
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Programmation à régler
                          </span>
                        @else
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                            Programmation à régler
                          </span>
                        @endif
                      </div>
                      <div
                        class="mt-2 flex items-center justify-end text-sm leading-5 text-gray-500">
                      @if ($week->start == \Gordesch\CineCarbon::now()->startOfWeek())
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                          Semaine en cours
                        </span>
                      @elseif ($week->start == \Gordesch\CineCarbon::now()->addWeek()->startOfWeek())
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                          Semaine prochaine
                        </span>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"/>
                </svg>
              </div>
            </div>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
