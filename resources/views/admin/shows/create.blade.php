<x-admin.layout title="Nouvelle fiche-film" category="shows">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M11,9 L11,5 L9,5 L9,9 L5,9 L5,11 L9,11 L9,15 L11,15 L11,11 L15,11 L15,9 L11,9 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,14.418278 5.581722,18 10,18 Z" clip-rule="evenodd"></path>
      </svg>
      Créer
    </x-admin.layout.header.button-primary>
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
