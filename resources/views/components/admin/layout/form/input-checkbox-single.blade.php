@props(['title', 'name', 'label', 'value', 'attrs', 'help'])

<div class="mt-6 sm:mt-5 sm:border-t sm:border-gray-200 sm:pt-5">
  <fieldset>
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
      <div>
        <legend class="text-base leading-6 font-medium text-gray-900 sm:text-sm sm:leading-5 sm:text-gray-700">
          {{ $title }}
        </legend>
      </div>
      <div class="mt-4 sm:mt-0 sm:col-span-2">
        <div class="max-w-lg">
          <div class="relative flex items-start border border-transparent">
            <div class="absolute flex items-center h-5">
              <input
                id="{{ $name }}"
                name="{{ $name }}"
                type="checkbox"
                class="form-checkbox mt-4 h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                value="1"
                @if ($value)
                checked
                @endif
              >
            </div>
            <div class="pl-7 text-sm leading-5">
              <label for="{{ $name }}" class="inline-block py-2 font-medium text-gray-700">
                {{ $label }}
              </label>
            @if ($help ?? null)
              <p class="text-gray-500">
                {{ $help }}
              </p>
            @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </fieldset>
</div>
