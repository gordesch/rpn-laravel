<x-admin.layout title="Adaptation des titres simplifiés" category="programmings">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.8792928,9.09695343 C18.6654343,9.4976045 20,11.09295 20,13 C20,15.209139 18.209139,17 16,17 L5,17 C2.23857625,17 0,14.7614237 0,12 C0,9.58046798 1.71857515,7.56233069 4.00162508,7.09968852 C4.00054449,7.06659179 4,7.03335948 4,7 C4,5.34314575 5.34314575,4 7,4 C7.55384606,4 8.07263826,4.1500834 8.51792503,4.41179863 C9.4182103,3.53797709 10.6462795,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,8.37684164 16.9583108,8.74394625 16.8792928,9.09695343 Z M10,7 L14,11 L6,11 L10,7 Z M9,11 L11,11 L11,14 L9,14 L9,11 Z" clip-rule="evenodd"></path>
      </svg>
      Importer les séances
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.showings.import.store') }}" class="mx-auto max-w-3xl">
    @csrf

    @if($shows->isEmpty())
      <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle"></i>
        <strong>Aucune correspondance à créer</strong>,
        toutes les fiche-films existent déjà. Vous pouvez importer les séances.
      </div>
    @else
      <div class="w-full flex justify-between items-center text-left">
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Films restant à faire correspondre
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Il faut soit importer la fiche correspondante, soit trouver le bon film dans notre base de données.
          </p>
        </div>
      </div>
    @endif

    @foreach ($shows as $show)
      <input
        type="hidden"
        name="match[{{ $show->ticketing_provider_id }}][ticketing_provider_id]"
        value="{{ $show->ticketing_provider_id }}"
      >
      <livewire:admin.shows.slug-check
        :name="'match['.$show->ticketing_provider_id.'][slug]'"
        :title="$show->title"
        :shouldExist="true"
        :value="$show->slug"
        width="md"
        :ticketingProviderId="$show->ticketing_provider_id"
        :poll="true"
      />
    @endforeach
  </form>
</x-admin.layout>
