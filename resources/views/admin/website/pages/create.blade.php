<x-admin.layout title="Nouvelle Page" category="website">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M11,9 L11,5 L9,5 L9,9 L5,9 L5,11 L9,11 L9,15 L11,15 L11,11 L15,11 L15,9 L11,9 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,14.418278 5.581722,18 10,18 Z" clip-rule="evenodd"></path>
      </svg>
      Créer
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.website.pages.store') }}">
    @csrf
    <div class="px-4 sm:px-0">
      <h3 class="text-lg font-medium leading-6 text-gray-900">Informations principales</h3>
      <p class="mt-1 text-sm leading-5 text-gray-500">
        Renseignez ici les informations concernant le contenu de la page.
      </p>
    </div>
    <div class="mt-5">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white sm:p-6">
          <label for="title" class="block text-sm font-medium leading-5 text-gray-700">Titre</label>
          <input
            id="title"
            name="title"
            class="max-w-lg mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            required
          />

          <div class="mt-6">
            <p class="block text-sm font-medium leading-5 text-gray-700">Contenu</p>
            <div class="mt-1 relative" style="min-height: {{ 200+26 }}px;">
              <x:admin.layout.editor.quill name="content" form="form" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-10">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Films associés</h3>
        <p class="mt-1 text-sm leading-5 text-gray-500">
          Sélectionnez ici les films qui seront associés à la page.
        </p>
      </div>
    </div>

    <div class="mt-5">
      <div class="flex bg-white px-4 py-5 sm:p-6 shadow sm:rounded-md">
        <livewire:admin.shows.select />
        <input
          type="text"
          class="block w-full h-16 px-3 py-2 border border-gray-300 leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out shadow-sm"
          placeholder="{{ Carbon\Carbon::now()->isoFormat('DD/MM/YYYY') }}"
          pattern="(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/(20)\d\d"
        >
      </div>
      <x:admin.layout.editor.quill name="show_raw_content" form="form" />
    </div>
  </form>


  <x-slot name="scripts">

  </x-slot>
</x-admin.layout>
