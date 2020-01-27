@extends('admin.app')

@section('title', "Création d'une fiche-film")

@section('content')

<h1>Fiches-film</h1>

<a class="btn btn-primary" href="{{ route('admin.shows.import.search.create') }}">Importer une fiche</a>
<a class="btn btn-default" href="{{ route('admin.shows.create') }}">Créer manuellement une fiche</a>

<show-autocomplete></show-autocomplete>

<table class="table table-striped table-responsive">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($shows as $show)
            <tr>
                <td>
                    <a href="{{ route('admin.shows.edit', [$show]) }}">
                        {{ $show->title }}
                    </a>
                </td>
                <td>
                    <a
                        class="btn btn-link"
                        href="{{ route('admin.shows.edit', [$show]) }}"
                        title="Modifier la fiche-film"
                    >
                        <i class="fa fa-pencil-square-o fa-fw"></i> Modifier
                    </a>
                    <form
                        style="display:inline;"
                        action="{{ route('admin.shows.destroy', [$show]) }}"
                        method="POST"
                    >
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-link" title="Supprimer la fiche-film">
                            <i class="fa fa-trash-o fa-fw"></i> Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
