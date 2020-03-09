<x-admin.layout title="Programmation"  category="programmings">
  <x-slot name="headerButtons">
    <x-admin.layout.header.button-primary innerHTML="Importer des séances" :href="route('admin.showings.import.create')" />
  </x-slot>
</x-admin.layout>
