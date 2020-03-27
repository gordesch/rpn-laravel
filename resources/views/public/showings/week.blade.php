<x-public.layout title="Cette semaine" category="showings">

  @foreach($week->programmings->map->show as $show)

    {{--@include('public.partials.shows.full')

    @if ($programming->custom_showings_infos)
        <p class="well" style="margin-top:20px;text-align:center">
            {{ $programming->custom_showings_infos }}
        </p>
    @else
        @include('public.partials.showings.table')
    @endif

    @include('public.partials.videos.full')--}}

  @endforeach
</x-public.layout>
