<x-admin.layout title="Importation d'une fiche-film" category="shows">
  <x-slot name="titleInnerHTML">
    <div class="flex-1 flex items-center">
      <x-admin.shows.poster :show="$show" />
      <span class="ml-3 truncate">
        {{ $show->title }}
      </span>
    </div>
  </x-slot>

  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary innerHTML="Importer" onclick="document.forms['form'].submit()" />
  </x-slot>

  <form method="post" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data" role="form" class="mx-auto max-w-3xl" id="form">
    @csrf

    @if ($show->ticketing_provider_id)
      <input type="hidden" name="ticketing_provider_id" value="{{ $show->ticketing_provider_id }}">
    @endif

    <div x-data="{ open: false, valid: null}" x-init="open = !JSON.parse($refs.slugcheck.dataset.valid);if(JSON.parse($refs.slugcheck.dataset.valid)){valid='true';}else{valid='false';}">
      <button @click.prevent="open = !open" class="w-full flex justify-between items-center text-left">
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Informations principales
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Les informations nécessaires lors de toute importation.
          </p>
        </div>
        <div class="flex-shrink-0">
          <svg x-show="valid === 'true'" class="h-10 w-10  text-green-400 " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>
      </button>
      <div x-show="open" style="display: none;">
        <x-admin.shows._form-main :show="$show" :slugShouldExist="false" />
      </div>
    </div>


    <div x-data="{ open: false}" class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
      <button @click.prevent="open = !open" class="w-full flex justify-between items-center text-left">
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Détails
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Vous pouvez vérifier ici les détails de la fiche-film.
          </p>
        </div>
        <div class="flex-shrink-0">
          <svg class="h-10 w-10  text-green-400 " viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>
      </button>
      <div x-show="open" style="display:none;">
        <x-admin.shows._form-details :show="$show" />
      </div>
    </div>

    <div class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Bandes-annonces
      </h3>
      <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
        Privilégiez les vidéos publiées par les distributeurs.
      </p>
    </div>
    <x-admin.videos.form :videos="$videos" />
  </form>
</x-admin.layout>
