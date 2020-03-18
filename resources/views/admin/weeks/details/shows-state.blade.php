<x-admin.layout title="État des fiches-film"  category="programmings">
  <x-slot name="titleInnerHTML">
    Semaine du {{ $week->start->isoFormat('dddd DD MMMM YYYY') }}
  </x-slot>

  <x-admin.weeks.submenu selected="shows-state" :week="$week" />

  <x-admin.weeks.shows-state.table :shows="$week->programmings->map->show" />
</x-admin.layout>
