@props('show', 'programming')
<div class="">
  <h2>
    {{ $show->title }}
    @if ($programming)
      @if(
          $programming->is_original_version
          || $programming->is_dubbed_version
          || $programming->show->audience
          || $programming->show->duration_in_seconds
      )
        <small>
          <x-public.shows.labels
            :is_original_version="$programming->is_dubbed_version"
            :is_dubbed_version="$programming->is_dubbed_version"
            :is_2d="$programming->is_2d"
            :is_3d="$programming->is_3d"
            :audience="$show->audience"
          />

          @if ($show->duration_in_seconds)
            {{ $show->duration->format('%hh%I') }}
          @endif
        </small>
      @endif
    @endif
  </h2>
</div>
