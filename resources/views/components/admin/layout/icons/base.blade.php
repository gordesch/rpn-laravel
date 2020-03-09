@props(['svgPath'])

<svg
  {{ $attributes->merge(['class' => '-ml-1 mr-2 h-5 w-5']) }}
  fill="currentColor"
  viewBox="0 0 20 20"
>
  <path fill-rule="evenodd" d="{{ $svgPath }}" clip-rule="evenodd"/>
</svg>
