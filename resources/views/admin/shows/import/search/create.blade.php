@extends('admin.app')

@section('title', "Importation d'une fiche-film")

@section('header-buttons')
    <livewire:admin.shows-search-input></livewire:admin.shows-search-input>
@endsection

@section('content')
    <livewire:admin.shows-import-search-list autofocus="true"></livewire:admin.shows-import-search-list>
@endsection
