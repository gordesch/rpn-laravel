<div class="page-header">
    <h2>
        {{ $show->title }}
        @if(
            $programming->is_original_version
            || $programming->is_dubbed_version
            || $programming->show->audience
            || $programming->show->duration_in_seconds
        )
            <small>
                @if ($programming->is_original_version)
                    @include('partials.shows.labels.is_original_version')
                @endif
                @if ($programming->is_dubbed_version)
                    @include('partials.shows.labels.is_dubbed_version')
                @endif
                @if ($programming->is_2d)
                    @include('partials.shows.labels.is_2d')
                @endif
                @if ($programming->is_3d)
                    @include('partials.shows.labels.is_3d')
                @endif

                @if ($show->audience === '18')
                    <abbr title="Film interdit aux moins de dix-huit ans" class="badge">-18</abbr>
                @elseif ($show->audience === '16')
                    <abbr title="Film interdit aux moins de seize ans" class="badge">-16</abbr>
                @elseif ($show->audience === '12')
                    <abbr title="Film interdit aux moins de douze ans" class="badge">-12</abbr>
                @elseif ($show->audience === 'av')
                    <abbr title="Avertissement : des scènes peuvent choquer les plus jeunes" class="badge">Avert.</abbr>
                @elseif ($show->audience && ($show->audience < 12))
                    <abbr class="badge">Dès {{ $show->audience }} ans</abbr>
                @endif

                @if ($show->duration_in_seconds)
                    {{ $show->duration->format('%hh%I') }}
                @endif
            </small>
        @endif
    </h2>
</div>
