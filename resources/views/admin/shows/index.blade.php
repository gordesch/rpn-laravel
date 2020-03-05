@extends('admin.app')

@section('title', "Dernières fiches-film")

@section('header-buttons')
    <livewire:admin.shows-search-input></livewire:admin.shows-search-input>
    <x-admin.layout.header.button-primary-dropdown mainRoute="admin.shows.import.search.create">
        <x-slot name="mainInnerHTML">
            <x-admin.layout.icons.plus-circle />
            Importer une fiche
        </x-slot>

        <x-admin.layout.header.button-primary-dropdown-item route="admin.shows.create">
            Création manuelle
        </x-admin.layout.header.button-primary-dropdown-item>
    </x-admin.layout.header.button-primary-dropdown>
@endsection

@section('content')

<!-- Dernières fiches créées -->
<livewire:admin.shows-search-list></livewire:admin.shows-search-list>

@endsection
