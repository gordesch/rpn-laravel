<div>
  <select
    wire:model="perPage"
    id="perPage" name="perPage"
    class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
  >
  <option>10</option>
    <option>25</option>
    <option>50</option>
  </select>
  <div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
          <thead>
          <tr>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              <div class="max-w-xs rounded-md shadow-sm">
                <select wire:model="show_id" id="show" name="show" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                  <option value="">Tous les films</option>
                  @foreach($shows as $show)
                    <option value="{{ $show->id }}">{{ $show->title }}</option>
                  @endforeach
                </select>
              </div>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              <select wire:model="date" id="date" name="date" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                <option value="">Toutes les dates</option>
                @foreach($dates as $date)
                  <option value="{{ $date->isoFormat('YYYY-MM-DD') }}">{{ $date->isoFormat('DD/MM/YYYY') }}</option>
                @endforeach
              </select>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              <select wire:model="time" id="time" name="time" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                <option value="">Toutes les heures</option>
                @foreach($times as $time)
                  <option value="{{ $time->isoFormat('HH:mm:ss') }}">{{ $time->isoFormat('HH:mm') }}</option>
                @endforeach
              </select>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
          </tr>
          </thead>
          <tbody class="bg-white">
          @forelse($showings as $showing)
            <tr>
              <td class="px-6 py-4 whitespace-no-wrap @if (!$loop->last) border-b border-gray-200 @endif text-sm leading-5 font-medium text-gray-900">
                {{ $showing->programming->show->title }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap @if (!$loop->last) border-b border-gray-200 @endif text-sm leading-5 text-gray-500">
                {{ $showing->datetime->isoFormat('DD/MM/YYYY') }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap @if (!$loop->last) border-b border-gray-200 @endif text-sm leading-5 text-gray-500">
                {{ $showing->datetime->isoFormat('HH:mm') }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right @if (!$loop->last) border-b border-gray-200 @endif text-sm leading-5 font-medium">
                <a href="#" class="text-indigo-600 hover:text-indigo-900 focus:outline-none focus:underline">Générer</a>
              </td>
            </tr>
          @empty
          @endforelse
          </tbody>
        </table>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="flex-1 flex justify-between sm:hidden">
            {{ $showings->links('livewire.simple-pagination-links') }}
          </div>
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm leading-5 text-gray-700">
                Résultats
                <span class="font-medium">{{ $showings->firstItem() }}</span>
                à
                <span class="font-medium">{{ $showings->lastItem() }}</span>
                sur
                <span class="font-medium">{{ $showings->total() }}</span>
              </p>
            </div>
            {{ $showings->links('livewire.pagination-links') }}
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
