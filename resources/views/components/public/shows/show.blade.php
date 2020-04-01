@props('show')
<article id="{{ $show->id }}">
  @include('partials.shows.title')

  <p>
    @include('partials.shows.details')
    @include('partials.shows.cast')
  </p>
  @include('partials.shows.audience-long')
  @include('partials.shows.synopsis')
</article>
