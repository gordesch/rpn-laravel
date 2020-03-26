@props(['href', 'ignoreMissing'])
<a href="{!! $href !!}" class="group block px-6 py-4" target="_blank">
  <svg class="h-6 w-6 mx-auto @if ($ignoreMissing) text-green-400 @else text-yellow-400 group-hover:text-yellow-500 @endif" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
  </svg>
</a>
