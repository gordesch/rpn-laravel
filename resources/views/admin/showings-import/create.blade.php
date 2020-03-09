<x-admin.layout title="Adaptation des titres simplifiés" category="programmings">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary innerHTML="Importer les séances" onclick="document.forms['form'].submit()"/>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.showings.import.store') }}" class="mx-auto max-w-3xl">
    @csrf

    @if($shows->isEmpty())
      <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle"></i>
        <strong>Aucune correspondance à créer</strong>,
        tous les films de cette programmation sont déjà importés.
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
      />
    @endforeach
  </form>
</x-admin.layout>
