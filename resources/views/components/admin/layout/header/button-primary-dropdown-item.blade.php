@props(['route'])
<div class="rounded-md bg-white shadow-xs">
  <div class="py-1">
    <a href="{{ route($route) }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">
      {{ $slot }}
    </a>
  </div>
</div>
