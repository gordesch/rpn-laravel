<x-admin.layout :title="$show->title" category="shows">
  <x-slot name="titleInnerHTML">
    <div class="flex-1 flex items-center">
      <livewire:admin.shows.poster :show="$show" :poll="$show->poster_is_pending" :key="$show->id" />
      <span class="ml-3 truncate">
        {{ $show->title }}
      </span>
    </div>
  </x-slot>

  <x-slot name="headerButtons">
    <x-admin.layout.header.button-secondary :href="route('admin.shows.videos.edit', [$show])">
      <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M0,3.99406028 C0,2.8927712 0.898212381,2 1.99079514,2 L18.0092049,2 C19.1086907,2 20,2.89451376 20,3.99406028 L20,16.0059397 C20,17.1072288 19.1017876,18 18.0092049,18 L1.99079514,18 C0.891309342,18 0,17.1054862 0,16.0059397 L0,3.99406028 Z M6,4 L14,4 L14,16 L6,16 L6,4 Z M2,5 L4,5 L4,7 L2,7 L2,5 Z M2,9 L4,9 L4,11 L2,11 L2,9 Z M2,13 L4,13 L4,15 L2,15 L2,13 Z M16,5 L18,5 L18,7 L16,7 L16,5 Z M16,9 L18,9 L18,11 L16,11 L16,9 Z M16,13 L18,13 L18,15 L16,15 L16,13 Z M8,7 L13,10 L8,13 L8,7 Z" clip-rule="evenodd"></path>
      </svg>
      Bandes-annonces
    </x-admin.layout.header.button-secondary>

    <form
      action="{{ route('admin.shows.destroy', [$show]) }}"
      method="POST"
      onsubmit="return confirm('Supprimer la fiche de {{ $show->title }} ?');"
      class="ml-3"
    >
      @method('DELETE')
      @csrf
      <x-admin.layout.header.button-secondary-danger type="submit" class="group">
        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M2,2 L18,2 L18,4 L2,4 L2,2 Z M8,0 L12,0 L14,2 L6,2 L8,0 Z M3,6 L17,6 L16,20 L4,20 L3,6 Z M8,8 L9,8 L9,18 L8,18 L8,8 Z M11,8 L12,8 L12,18 L11,18 L11,8 Z" clip-rule="evenodd"></path>
        </svg>
        Supprimer
      </x-admin.layout.header.button-secondary-danger>
    </form>

    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group ml-3">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M0,1.99079514 C0,0.891309342 0.894513756,0 1.99406028,0 L16,0 L20,4 L20,18.0059397 C20,19.1072288 19.1017876,20 18.0092049,20 L1.99079514,20 C0.891309342,20 0,19.1017876 0,18.0092049 L0,1.99079514 Z M5,2 L15,2 L15,8 L5,8 L5,2 Z M11,3 L14,3 L14,7 L11,7 L11,3 Z" clip-rule="evenodd"></path>
      </svg>
      Sauvegarder
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.shows.update', [$show]) }}" role="form">
    @method('PUT')
    <x-admin.shows.form :show="$show" :slugShouldExist="false" mode="edit"/>
  </form>
</x-admin.layout>
