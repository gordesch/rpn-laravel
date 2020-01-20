@extends('admin.app')

@section('title', "Programmation")

@section('content')

<h1>Programmation</h1>

<a class="btn btn-primary" href="{{ route('admin.showings.import.create') }}">Importer une nouvelle programmation</a>

@endsection
