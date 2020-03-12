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
    <x-admin.layout.header.button-secondary :href="route('admin.shows.videos.edit', [$show])">
      <x-slot name="innerHTML">
        <x-admin.layout.icons.edit />
        Bandes-annonces
      </x-slot>
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
        <x-slot name="innerHTML">
          <x-admin.layout.icons.trash class="text-gray-400 group-hover:text-white"/>
          Supprimer
        </x-slot>
      </x-admin.layout.header.button-secondary-danger>
    </form>

    <x-admin.layout.header.button-primary onclick="document.forms['form'].submit()" class="ml-3">
      <x-slot name="innerHTML">
        <x-admin.layout.icons.edit/>
        Sauvegarder
      </x-slot>
    </x-admin.layout.header.button-primary>
  </x-slot>

  <form id="form" method="post" action="{{ route('admin.shows.update', [$show]) }}" role="form">
    @method('PUT')
    <x-admin.shows.form :show="$show" :slugShouldExist="false" mode="edit"/>
  </form>
</x-admin.layout>
