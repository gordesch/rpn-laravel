@extends('admin.app')

@section('title', "Adaptation des titres simplifiés")

@section('content')

<div class="page-header">
    <h1>Adaptation des titres simplifiés</h1>
</div>

<form method="post" action="{{ route('admin.showings.import.store') }}">
    @csrf

    @if($shows->isEmpty())
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i>
            <strong>Aucune correspondance à créer</strong>,
            tous les films de cette programmation sont déjà importés.
        </div>
    @endif

    @foreach ($shows as $show)
        <input
            type="hidden"
            name="match[{{ $show->ticketing_provider_id }}][ticketing_provider_id]"
            value="{{ $show->ticketing_provider_id }}"
        >
        <slug-check
            id="{{ $show->ticketing_provider_id }}"
            label="{{ $show->title }}"
            name="match[{{ $show->ticketing_provider_id }}][slug]"
            shouldexist="true"
            value="{{ $show->slug }}"
            ticketing_provider_id="{{ $show->ticketing_provider_id }}"
        ></slug-check>
    @endforeach
    <div class="form-actions">
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Importer la programmation" >
    </div>
</form>

@endsection

@section('scripts')
@endsection
