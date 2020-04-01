@props('is_dubbed_version', 'is_original_version', 'is_2d', 'is_3d', 'audience')
@if ($is_dubbed_version)
  <x-public.shows.label type="is_dubbed_version" />
@endif
@if ($is_original_version)
  <x-public.shows.label type="is_original_version" />
@endif
@if ($is_2d)
  <x-public.shows.label type="is_2d" />
@endif
@if ($is_3d)
  <x-public.shows.label type="is_3d" />
@endif
@if ($audience)
  <x-public.shows.label :type="$audience" />
