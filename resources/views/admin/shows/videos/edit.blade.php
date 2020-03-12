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
    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="ml-3">
      <x-slot name="innerHTML">
        <x-admin.layout.icons.edit/>
        Sauvegarder
      </x-slot>
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.shows.videos.update', [$show]) }}" role="form">
    @csrf
    @method('PUT')
    <x-admin.shows.videos.form :show="$show" :videos="$videos" />
  </form>
</x-admin.layout>
