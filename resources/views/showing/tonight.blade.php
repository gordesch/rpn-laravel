@extends('layouts.app')

@section('title', "Ce soir")

@section('content')

<div class="page-header">
    <h1>Ce soir <small>séances après 18h30</small></h1>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th colspan="2" style="text-align:center;">
                <ul class="pager" style="margin: 0">
                    <nav>
                        <li class="previous">
                            <a href="{{ route('showing.tonight', $date->subDay()->format('Y-m-d')) }}">
                                <span aria-hidden="true">←</span>
                                La veille
                            </a>
                        </li>
                        <li>
                            <span>
                                {{ $date->formatLocalized("%A %d %B %G") }}
                            </span>
                        </li>
                        <li class="next">
                            <a href="{{ route('showing.tonight', $date->addDay()->format('Y-m-d')) }}">
                                Le lendemain
                                <span aria-hidden="true">→</span>
                            </a>
                        </li>
                    </nav>
                </ul>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($showings as $showing)
            @php $show = $showing->programming->show @endphp
            <tr>
                <td>
                    @include('partials.showings.button')
                </td>
                <td>
                    {{ $show->title }}
                    <button
                        onclick="afficher_cacher_ligne('{{ $showing->id }}')"
                        class="btn btn-sm btn-default"
                    >
                        Afficher les détails
                    </button>
                </td>
            </tr>
            <tr id="{{ $showing->id }}" style="display:none;">
                <td colspan="2">
                    @include('partials.shows.details')
                    @include('partials.shows.audience-long')
                    @include('partials.shows.synopsis')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" style="text-align:center">
                    <em>Horaires indisponibles pour ce jour</em>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection

@section('scripts')

@endsection
