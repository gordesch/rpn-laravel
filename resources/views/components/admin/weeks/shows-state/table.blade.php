<div class="flex flex-col">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
      <table class="table-fixed min-w-full">
        <tbody class="bg-white">
          @foreach($shows as $show)
            @if (($loop->index % 5) === 0 )
              </tbody>
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
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                </tr>
              </thead>
              <tbody class="bg-white">
            @endif
              @livewire('admin.weeks.shows-state', ['show' => $show])
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
