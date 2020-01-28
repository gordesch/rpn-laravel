@extends('admin.app')

@section('title', "Création d'une fiche-film")

@section('content')

<div class="page-header">
    <h1>
        Fiches-film
        <a class="btn btn-primary" href="{{ route('admin.shows.import.search.create') }}">
            <i class="fa fa-plus-circle"></i>
            Importer une fiche
        </a>
        <a class="btn btn-default" href="{{ route('admin.shows.create') }}">
            <i class="fa fa-plus-circle"></i>
            Créer manuellement une fiche
        </a>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-search"></i>
                    Recherche
                </h3>
            </div>
            <div class="panel-body">
                <div class="form-inline">
                    <div class="form-group">
                        <show-autocomplete v-on:input="setSearch"></show-autocomplete>
                    </div>
                    <a v-bind:href="showUrl" class="btn btn-default">
                        Fiche
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    <a v-bind:href="videosUrl" class="btn btn-default">
                        Bandes-annonces
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="page-header">
            <h3>
                <i class="fa fa-sort-numeric-asc"></i>
                Dernières fiches-films créées
            </h3>
        </div>

        <div class="list-group">
            @foreach($shows as $show)
                <a href="{{ route('admin.shows.edit', [$show]) }}" class="list-group-item">
                    {{ $show->title }}
                </a>
            @endforeach
        </div>
    </div>
</div>


@endsection
