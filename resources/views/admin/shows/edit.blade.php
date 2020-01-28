@extends('admin.app')

@section('title', "Modification d'une fiche-film")

@section('content')
<div class="page-header">
    <h1>
        Fiche-film
    </h1>
</div>
<form
    style="display:inline;"
    action="{{ route('admin.shows.destroy', [$show]) }}"
    method="POST"
    onsubmit="return confirm('Supprimer la fiche de {{ $show->title }} ?');"
>
    @method('DELETE')
    @csrf
    <button type="submit" class="btn btn-danger" title="Supprimer la fiche-film">
        <i class="fa fa-trash-o fa-fw"></i> Supprimer
    </button>
</form>

<form class="form" method="post" action="{{ route('admin.shows.update', [$show]) }}" enctype="multipart/form-data" role="form" style="padding-top:20px">
    @method('PUT')
    @include('admin.shows._form')
    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier la fiche-film">
</form>
@endsection

@section('scripts')
@endsection
