@props(['href', 'category', 'linkCategory'])

<a
  href="{{ $href }}"
  @if ($category === $linkCategory)
    {{ $attributes->merge(['class' => 'px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700']) }}
  @else
  {{ $attributes->merge(['class' => 'px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700']) }}
  @endif
>
  {{ $slot }}
</a>
