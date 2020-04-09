@props(['title', 'name', 'value' => null, 'attrs' => null, 'width', 'state' => null, 'help'])

<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
  <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
    {{ $title }}
  </label>
  <div class="mt-1 sm:mt-0 sm:col-span-2">
    <div
        @if ($width === '4')
          class="w-16 rounded-md shadow-sm relative"
        @elseif ($width === '6')
        class="w-20 rounded-md shadow-sm relative"
        @elseif ($width === 'xs')
          class="max-w-xs rounded-md shadow-sm relative"
        @elseif ($width === 'sm')
          class="max-w-sm rounded-md shadow-sm relative"
        @elseif ($width === 'md')
        class="max-w-md rounded-md shadow-sm relative"
        @elseif ($width === 'lg')
        class="max-w-lg rounded-md shadow-sm relative"
        @endif
    >
      <input
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($state === 'error')
          class="form-input block w-full pr-10 border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red sm:text-sm sm:leading-5"
        @elseif ($state === 'warning')
          class="form-input block w-full pr-10 border-orange-300 text-orange-900 placeholder-orange-300 focus:border-orange-300 focus:shadow-outline-orange sm:text-sm sm:leading-5"
        @elseif ($state === 'success')
          class="form-input block w-full pr-10 border-green-300 text-green-900 placeholder-green-300 focus:border-green-300 focus:shadow-outline-green sm:text-sm sm:leading-5"
        @else
        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
        @endif
        value="{{ old($name, $value) }}"
        {{ $attrs }}
          placeholder="{{ $placeholder ?? null }}"
        type="text"
      />
      @if ($state === 'error')
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
      </div>
      @elseif ($state === 'warning')
      @elseif ($state === 'success')
      @endif
    </div>
    @if (isset($help))
      <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
  </div>
</div>
