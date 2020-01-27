@extends('admin.app')

@section('title', "Modification d'une fiche-film")

@section('content')

    <form class="form" method="post" action="{{ route('admin.shows.update', [$show]) }}" enctype="multipart/form-data" role="form" style="padding-top:20px">

        @method('PUT')

        @include('admin.shows._form')

        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier la fiche-film">
    </form>
@endsection

@section('scripts')
@endsection
