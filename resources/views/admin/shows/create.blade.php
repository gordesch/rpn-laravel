@extends('admin.app')

@section('title', "Création d'une fiche-film")

@section('content')

    <form class="form" method="post" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data" role="form" style="padding-top:20px">

        @include('admin.shows._form')
        @include('admin.shows.partials.video-search-containers')

        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Créer la fiche-film">
    </form>
@endsection

@section('scripts')
@endsection
