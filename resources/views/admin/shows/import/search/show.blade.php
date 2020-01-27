@extends('admin.app')

@section('title', "Importation d'une fiche-film")

@section('content')

<form class="form" method="get" action="" style="padding-top:20px">

    <div class="form-group">
        <label for="searched_show" class="control-label">Titre du film :</label>
        <input type="text"
               name="searched_show"
               id="searched_show"
               class="form-control"
               placeholder="Ex : Tout sur ma mère"
               size="30"
               maxlength="255"
               value="{{ request('searched_show') }}"
               required />
        <div class="open">
            <ul class="dropdown-menu" style="position: initial;">
                @foreach ($shows as $show)
                    <li>
                        <a href="{{ route('admin.shows.import.create') }}?code={{ $show->shows_provider_id }}">
                            <strong>{{ $show->title }}</strong>
                            @if ($show->director)
                                de {{ $show->director }}
                            @endif
                            @if ($show->year OR $show->release_date)
                                ({{ $show->year ?? '' }}{{ $show->release_date ? ', sortie le ' . $show->release_date : '' }})
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</form>

@endsection
