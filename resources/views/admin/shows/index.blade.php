@extends('admin.app')

@section('title', "Création d'une fiche-film")

@section('content')

<h1>Fiches-film <a class="btn btn-primary" href="{{ route('admin.shows.import.search.create') }}">Importer depuis Allociné</a></h1>

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
                    <a href="fiche-film.php?f='.$films['film'].'">
                        {{ $show->title }}
                    </a>
                </td>
                <td>
                    <a href="{{ route('admin.shows.edit', [$show]) }}" title="Modifier la fiche-film">
                        <i class="fa fa-pencil-square-o fa-fw"></i> Modifier
                    </a>
                    &nbsp;-&nbsp;
                    <a href="{{ route('admin.shows.destroy', [$show]) }}" title="Supprimer la fiche-film">
                        <i class="fa fa-trash-o fa-fw"></i> Supprimer
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
