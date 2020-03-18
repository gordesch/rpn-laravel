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
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()">
      <svg class="h-5 w-5 -ml-1 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M16.8792928,9.09695343 C18.6654343,9.4976045 20,11.09295 20,13 C20,15.209139 18.209139,17 16,17 L5,17 C2.23857625,17 0,14.7614237 0,12 C0,9.58046798 1.71857515,7.56233069 4.00162508,7.09968852 C4.00054449,7.06659179 4,7.03335948 4,7 C4,5.34314575 5.34314575,4 7,4 C7.55384606,4 8.07263826,4.1500834 8.51792503,4.41179863 C9.4182103,3.53797709 10.6462795,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,8.37684164 16.9583108,8.74394625 16.8792928,9.09695343 Z M10,7 L14,11 L6,11 L10,7 Z M9,11 L11,11 L11,14 L9,14 L9,11 Z" clip-rule="evenodd"></path>
      </svg>
      Importer la fiche
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form method="post" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data" role="form" id="form">
    @csrf

    @if ($show->ticketing_provider_id)
      <input type="hidden" name="ticketing_provider_id" value="{{ $show->ticketing_provider_id }}">
    @endif

    <div x-data="{ open: false, valid: null}" x-init="open = !JSON.parse($refs.slugcheck.dataset.valid);if(JSON.parse($refs.slugcheck.dataset.valid)){valid='true';}else{valid='false';}" class="mx-auto max-w-3xl">
      <button @click.prevent="open = !open" class="w-full flex justify-between items-center text-left">
        <div class="flex-shrink-0 mr-3">
          <svg x-show="!open" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
          <svg x-show="open" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Informations principales
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Les informations nécessaires lors de toute importation.
          </p>
        </div>
        <div class="flex-shrink-0">
          <svg x-show="valid === 'true'" class="mr-4 h-10 w-10  text-green-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>
      </button>
      <div x-show="open" style="display: none;">
        <x-admin.shows._form-main :show="$show" :slugShouldExist="false" />
      </div>
    </div>


    <div x-data="{ open: false}" class="mx-auto max-w-3xl mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
      <button @click.prevent="open = !open" class="w-full flex justify-between items-center text-left">
        <div class="flex-shrink-0 mr-3">
          <svg x-show="!open" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
          <svg x-show="open" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
        <div class="flex-grow">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Détails
          </h3>
          <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
            Vous pouvez vérifier ici les détails de la fiche-film.
          </p>
        </div>
        <div class="flex-shrink-0">
          <svg class="mr-4 h-10 w-10  text-green-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>
      </button>
      <div x-show="open" style="display:none;">
        <x-admin.shows._form-details :show="$show" />
      </div>
    </div>
    <livewire:form :showTitle="$show->title" :showIsLocalLanguage="$show->is_local_language" />
  </form>
</x-admin.layout>
