@props('type')
@php
  if ($type === 'is_2d') {
    $title = 'Projection régulière (sans relief)';
    $label = '2D';
    $class = '';
  } elseif ($type === 'is_3d') {
    $title = 'Projection en relief stéréoscopique';
    $label = '3D';
    $class = '';
  } elseif ($type === 'is_dubbed_version') {
    $title = 'Version doublée en français';
    $label = 'VF';
    $class = '';
  } elseif ($type === 'is_original_version') {
    $title = 'Version originale sous-titrée en français';
    $label = 'VOST';
    $class = '';
  } elseif ($type == 0) {
      $title = 'Film interdit aux moins de dix-huit ans';
      $label = '-18';
      $class = '';
  }elseif ($type == 18) {
      $title = 'Film interdit aux moins de dix-huit ans';
      $label = '-18';
      $class = '';
  } elseif ($type == 16) {
      $title = 'Film interdit aux moins de seize ans';
      $label = '-16';
      $class = '';
  } elseif (type == 12) {
      $title = 'Film interdit aux moins de douze ans';
      $label = '-12';
      $class = '';
  }
@endphp
<abbr
  title="{{ $title }}"
  class=" {{ $class }}"
>
  {{ $label }}
</abbr>
