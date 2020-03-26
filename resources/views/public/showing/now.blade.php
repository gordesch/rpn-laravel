@extends('layouts.app')

@section('title', "Maintenant")

@section('content')

    <div class="page-header">
        <h1>Maintenant <small>séances d'ici deux heures</small></h1>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th colspan="2" style="text-align:center;">
                <ul class="pager" style="margin: 0">
                    <nav>
                        <li class="previous">
                            <a href="{{ route('showing.now', $from->subHours(2)->format('H:i')) }}">
                                <span aria-hidden="true">←</span>
                                Plus tôt
                            </a>
                        </li>
                        <li>
                            <span>
                                {{ $from->formatLocalized("%A %d %B %G") }}
                                de {{ $from->format('H\hi') }}
                                à {{ $from->addHours(2)->format('H\hi') }}
                            </span>
                        </li>
                        <li class="next">
                            <a href="{{ route('showing.now', $from->addHours(2)->format('H:i')) }}">
                                Plus tard
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
                        <em>Aucune séance durant ce créneau horaire</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection

@section('scripts')

@endsection
