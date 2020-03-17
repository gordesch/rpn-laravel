@props(['innerHTML', 'href'])
@if ($href)
<a
  href="{{ $href ?? null }}"
@else
<button
@endif
  {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out']) }}
>
  {{ $slot }}
@if (!$href)
</button>
@else
</a>
@endif
