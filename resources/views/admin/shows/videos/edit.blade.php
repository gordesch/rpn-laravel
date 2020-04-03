<x-admin.layout :title="$show->title" category="shows">
  <x-slot name="titleInnerHTML">
    <div class="flex-1 flex items-center">
      <x-admin.shows.poster :show="$show"/>
      <span class="ml-3 truncate">
        {{ $show->title }}
      </span>
    </div>
  </x-slot>

  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="group ml-3">
      <svg class="-ml-1 mr-2 h-5 w-5 text-indigo-50 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M0,1.99079514 C0,0.891309342 0.894513756,0 1.99406028,0 L16,0 L20,4 L20,18.0059397 C20,19.1072288 19.1017876,20 18.0092049,20 L1.99079514,20 C0.891309342,20 0,19.1017876 0,18.0092049 L0,1.99079514 Z M5,2 L15,2 L15,8 L5,8 L5,2 Z M11,3 L14,3 L14,7 L11,7 L11,3 Z" clip-rule="evenodd"></path>
      </svg>
      Remplacer
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.shows.videos.update', [$show]) }}" role="form">
    @csrf
    @method('PUT')
    <livewire:admin.shows.videos.form :showTitle="$show->title" :showIsLocalLanguage="(bool) $show->is_local_language" />
  </form>
</x-admin.layout>
