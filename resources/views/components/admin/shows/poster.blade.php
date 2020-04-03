<div class="flex-shrink-0">
  @if (!empty($show->poster_url || $show->getFirstMediaUrl('posters', 'sm')))
    <img
        class="h-12 w-9 border border-gray-300 rounded-sm shadow-inner bg-gray-100"
        src="{{ $show->poster_url ? Str::replaceFirst('http://', 'https://', $show->poster_url) : $show->getFirstMediaUrl('posters', 'sm') }}"
        srcset="
          {{ $show->poster_url ? Str::replaceFirst('http://', 'https://', $show->poster_url) : $show->getFirstMediaUrl('posters', 'sm')  }} 1x,
          {{ $show->poster_url ? Str::replaceFirst('http://', 'https://', $show->poster_url) : $show->getFirstMediaUrl('posters', 'sm@2x')  }} 2x
        "
        alt=""
    />
  @elseif($show->wasRecentlyCreated)
    <div class="flex justify-center align-items-center h-12 w-9 border border-gray-400 rounded-sm shadow-inner bg-gray-100 opacity-25 spinner">
    </div>
  @else
    <div class="flex justify-center align-items-center h-12 w-9 border border-gray-400 rounded-sm shadow-inner bg-gray-100 opacity-25">
    </div>
  @endif
</div>
