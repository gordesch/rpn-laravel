@props(['title', 'name', 'value', 'attrs', 'state', 'help'])

<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
  <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
    {{ $title }}
  </label>
  <div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-lg rounded-md shadow-sm relative">
      <textarea
          id="{{ $name }}"
          name="{{ $name }}"
          @if ($state === 'error')
          class="form-textarea block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red sm:text-sm sm:leading-5"
          @elseif ($state === 'warning')
          class="form-textarea block w-full pr-10 border-orange-300 text-orange-900 placeholder-orange-300 focus:border-orange-300 focus:shadow-outline-orange sm:text-sm sm:leading-5"
          @elseif ($state === 'success')
          class="form-textarea block w-full pr-10 border-green-300 text-green-900 placeholder-green-300 focus:border-green-300 focus:shadow-outline-green sm:text-sm sm:leading-5"
          @else
          class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          @endif
          {{ $attrs }}
      >{{ old($name, $value) }}</textarea>
    </div>
    @if (isset($help))
      <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
  </div>
</div>
