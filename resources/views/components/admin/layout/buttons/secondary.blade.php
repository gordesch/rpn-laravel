@props(['innerHTML', 'href'])
@if ($href)
  <a
    href="{{ $href ?? null }}"
@else
  <button
    @endif
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out']) }}
  >
    {!! $innerHTML !!}
    @if (!$href)
  </button>
  @else
  </a>
@endif
