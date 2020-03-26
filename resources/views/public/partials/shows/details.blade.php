@php
    $genre_director = '';
    if ($show->genre) {
        $genre_director .= \Illuminate\Support\Str::ucfirst($show->genre);
    }
    if ($show->genre && $show->director) {
        $genre_director .= ' de ';
    } elseif ($show->director) {
        $genre_director .= $show->director;
    }
    $duration
        = $show->duration_in_seconds
        ? $show->duration->format('%hh%I')
        : null;
    $details = array_filter([
        $genre_director,
        $duration,
        $show->country,
        $show->year,
    ]);
    $details = implode(' – ', $details);
@endphp

@if ($details)
    {{ $details }} <br>
@endif
