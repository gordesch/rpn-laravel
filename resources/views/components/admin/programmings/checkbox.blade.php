@props(['programming', 'for', 'label'])
<label
  for="programming[{{ $programming->id }}][{{ $for }}]"
  class="flex items-center justify-center px-3 py-0.5 rounded-full cursor-pointer
    @if ($for === 'is_dubbed_version')
      md:mr-2 bg-green-100 text-green-800
    @elseif ($for === 'is_original_version')
      md:mr-2 bg-blue-100 text-blue-800
    @elseif ($for === 'is_2d')
      md:mr-2 bg-teal-100 text-teal-800
    @elseif ($for === 'is_3d')
      bg-red-100 text-red-800
    @endif
  "
>
  <input
    class="form-checkbox mr-1 h-4 w-4 transition duration-150 ease-in-out
      @if ($for === 'is_dubbed_version')
        text-green-800
      @elseif ($for === 'is_original_version')
        text-blue-800
      @elseif ($for === 'is_2d')
        text-teal-800
      @elseif ($for === 'is_3d')
        text-red-800
      @endif
    "
    value="1"
    name="programming[{{ $programming->id }}][{{ $for }}]"
    id="programming[{{ $programming->id }}][{{ $for }}]"
    type="checkbox"
    @if ($programming->$for)
    checked
    @endif
  />
  <span class="">
    {{ $label }}
  </span>
</label>
