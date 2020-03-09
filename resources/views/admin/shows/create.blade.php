<x-admin.layout title="Nouvelle fiche-film" category="shows">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary innerHTML="Créer" onclick="document.forms['form'].submit()" />
  </x-slot>

  <form method="post" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data" role="form" class="mx-auto max-w-3xl" id="form">
    @csrf

    @if ($show->ticketing_provider_id)
      <input type="hidden" name="ticketing_provider_id" value="{{ $show->ticketing_provider_id }}">
    @endif

    <div>
      <div class="w-full flex justify-between items-center text-left">
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Informations principales
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Les informations nécessaires lors de toute importation.
          </p>
        </div>
      </div>
      <div>
        <x-admin.shows._form-main :show="$show" :slugShouldExist="false" />
      </div>
    </div>


    <div class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
      <div class="w-full flex justify-between items-center text-left">
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Détails
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Vous pouvez vérifier ici les détails de la fiche-film.
          </p>
        </div>
      </div>
      <div>
        <x-admin.shows._form-details :show="$show" />
      </div>
    </div>
  </form>
</x-admin.layout>
