<x-admin.layout title="Séances"  category="programmings">
  <x-slot name="titleInnerHTML">
    Semaine du {{ $week->start->isoFormat('dddd DD MMMM YYYY') }}
  </x-slot>

  <x-admin.weeks.submenu selected="programmings.showings.index" :week="$week" />

  <livewire:admin.showings.table :week="$week" />
</x-admin.layout>
