<x-admin.layout.header.button-primary-dropdown :href="route('admin.shows.import.search.create') . '?search=' . $search">
  <x-slot name="mainInnerHTML">
    <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M11,9 L11,5 L9,5 L9,9 L5,9 L5,11 L9,11 L9,15 L11,15 L11,11 L15,11 L15,9 L11,9 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z M10,18 C14.418278,18 18,14.418278 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,14.418278 5.581722,18 10,18 Z" clip-rule="evenodd"></path>
    </svg>
    Importer une fiche
  </x-slot>

  <x-admin.layout.header.button-primary-dropdown-item route="admin.shows.create">
    Création manuelle
  </x-admin.layout.header.button-primary-dropdown-item>
</x-admin.layout.header.button-primary-dropdown>
