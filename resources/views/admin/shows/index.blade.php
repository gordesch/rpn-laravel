<x-admin.layout title="Dernières fiches-film" category="shows">
  <x-slot name="headerButtons">
    <livewire:admin.shows.search-input />
    <livewire:admin.shows.import-button />
  </x-slot>
  <livewire:admin.shows.search-list />
</x-admin.layout>
