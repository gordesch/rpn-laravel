<x-admin.layout title="Programmations"  category="programmings">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary innerHTML="Importer des séances" :href="route('admin.showings.import.create')" />
  </x-slot>
  <x-admin.weeks.list :weeks="$weeks" />
</x-admin.layout>
