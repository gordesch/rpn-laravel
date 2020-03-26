@extends('layouts.app')

@section('title', "À l'affiche")

@section('content')

@foreach($week->programmings as $programming)
    @php $show = $programming->show @endphp

    @include('partials.shows.full')

    @if ($programming->custom_showings_infos)
        <p class="well" style="margin-top:20px;text-align:center">
            {{ $programming->custom_showings_infos }}
        </p>
    @else
        @include('partials.showings.table')
    @endif

    @include('partials.videos.full')

@endforeach

@endsection

@section('scripts')

@endsection
