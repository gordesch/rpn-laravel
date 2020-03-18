<div class="flex flex-col">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
      <table class="table-fixed min-w-full">
        @foreach($shows as $show)
          @if (($loop->index % 5) === 0 )
            <thead>
              <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Film
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Genre
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Durée
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Pays
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Année
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Réal.
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider truncate">
                  Casting
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider truncate">
                  Synopsis
                </th>
                <th class="w-1/12 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider truncate">
                  B.A.
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
              </tr>
            </thead>
          @endif
          <tbody class="bg-white">
            <tr
              @if (!$show->duration_in_seconds || !$show->genre || !$show->synopsis || !$show->videos_count )
                class="bg-red-50"
              @elseif (!$show->country || !$show->year || !$show->director || !$show->cast)
                class="bg-yellow-50"
              @endif
            >
              <td class="max-w-xs px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                <div class="flex items-center">
                  <x-admin.shows.poster :show="$show" />
                  <h4 class="block ml-5 text-sm font-medium leading-5 text-gray-700 truncate">
                    {{ $show->title }}
                  </h4>
                </div>
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->duration_in_seconds)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing-important :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->genre)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing-important :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->country)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->year)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->director)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->cast)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->synopsis)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing-important :show="$show" />
                @endif
              </td>
              <td class="whitespace-no-wrap border-b border-gray-200">
                @if ($show->videos_count)
                  <x-admin.weeks.shows-state.valid />
                @else
                  <x-admin.weeks.shows-state.missing-important :show="$show" forVideos="true"/>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                <a href="#" class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
