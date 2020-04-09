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
    <div class="">
      <div class="">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Informations principales</h3>
          <p class="mt-1 text-sm leading-5 text-gray-500">
            Renseignez ici les informations concernant le contenu de la page.
          </p>
        </div>
      </div>
      <div class="mt-5">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white sm:p-6">
            <label for="title" class="block text-sm font-medium leading-5 text-gray-700">Titre</label>
            <input id="title" name="title" class="max-w-lg mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />

            <div class="mt-6">
              <p class="block text-sm font-medium leading-5 text-gray-700">Contenu</p>
              <div class="mt-1">
                <textarea id="editor" name="content" hidden></textarea>
              </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <span class="inline-flex rounded-md shadow-sm">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                Save
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="hidden sm:block">
      <div class="py-5">
        <div class="border-t border-gray-200"></div>
      </div>
    </div>

    <div class="mt-10 sm:mt-0">
      <div class="">
        <div class="">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Films associés</h3>
            <p class="mt-1 text-sm leading-5 text-gray-500">
              Sélectionnez ici les films qui seront associés à la page.
            </p>
          </div>
        </div>
        <div class="mt-5">
          <div>
            <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <label for="shows" class="block text-sm font-medium leading-5 text-gray-700">Film</label>
                <input id="shows" class="max-w-lg mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>


  <x-slot name="scripts">
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
      Laraberg.init('editor');
    </script>
  </x-slot>
</x-admin.layout>
