@extends('admin.app')

@section('title', "Importation d'une fiche-film")

@section('content')

<form class="form" method="get" action="{{ route('admin.shows.import.search') }}" style="padding-top:20px">

    <div class="form-group">
        <label for="searched_show" class="control-label">Titre du film :</label>
        <input type="text"
               name="searched_show"
               id="searched_show"
               class="form-control"
               placeholder="Tout sur ma mère"
               size="30"
               maxlength="255"
               required
               autofocus />
    </div>

    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Rechercher" />
</form>

@endsection
