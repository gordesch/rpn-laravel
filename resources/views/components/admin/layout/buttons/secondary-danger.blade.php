@props(['innerHTML', 'href'])
@if ($href)
  <a
    href="{{ $href ?? null }}"
@else
  <button
    @endif
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:border-red-500 hover:text-white hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150']) }}
  >
    {{ $slot }}
    @if (!$href)
  </button>
  @else
  </a>
@endif
