<x-public.layout title="Maintenant" subtitle="Séances d'ici deux heures" category="showings">
  <div class="max-w-4xl mx-auto flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
          <thead class="bg-gray-50">
          <tr>
            <th class="flex justify-between px-6 py-3 border-b border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" colspan="2">
              <a class="hover:text-gray-700" href="{{ route('showing.now', $from->subHours(2)->format('H:i')) }}">
                <span aria-hidden="true">←</span>
                Plus tôt
              </a>
              <span>
                {{ $from->formatLocalized("%A %d %B %G") }}
                de {{ $from->format('H\hi') }}
                à {{ $from->addHours(2)->format('H\hi') }}
              </span>
              <a class="hover:text-gray-700" href="{{ route('showing.now', $from->addHours(2)->format('H:i')) }}">
                Plus tard
                <span aria-hidden="true">→</span>
              </a>
            </th>
          </tr>
          </thead>
          <tbody class="bg-white">
          @forelse($showings as $showing)
            @php $show = $showing->programming->show @endphp
            <tr>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                @include('partials.showings.button')
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                {{ $show->title }}
                <button
                  onclick="afficher_cacher_ligne('{{ $showing->id }}')"
                  class="btn btn-sm btn-default"
                >
                  Afficher les détails
                </button>
              </td>
            </tr>
            <tr id="{{ $showing->id }}" style="display:none;">
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900" colspan="2">
                @include('partials.shows.details')
                @include('partials.shows.audience-long')
                @include('partials.shows.synopsis')
              </td>
            </tr>
          @empty
            <tr>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900 text-center" colspan="2">
                <em>Aucune séance durant ce créneau horaire</em>
              </td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-public.layout>
