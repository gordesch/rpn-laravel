<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
  <label for="audience" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
    Âge et interdictions
  </label>
  <div class="mt-1 sm:mt-0 sm:col-span-2">
    <div class="max-w-xs rounded-md shadow-sm">
      <select id="audience" name="audience" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        <option value="" @if (old('audience', $audience) == null) selected @endif>Tous publics</option>
        <option value="0" @if (old('audience', $audience) === 0) selected @endif>Avertissement</option>
        <option value="18" @if (old('audience', $audience) === 18) selected @endif>Interdit aux moins de 18 ans</option>
        <option value="16" @if (old('audience', $audience) === 16) selected @endif>Interdit aux moins de 16 ans</option>
        <option value="12" @if (old('audience', $audience) === 12) selected @endif>Interdit aux moins de 12 ans</option>
        <option value="11" @if (old('audience', $audience) === 11) selected @endif>Dès 11 ans</option>
        <option value="10" @if (old('audience', $audience) === 10) selected @endif>Dès 10 ans</option>
        <option value="9" @if (old('audience', $audience) === 9) selected @endif>Dès 9 ans</option>
        <option value="8" @if (old('audience', $audience) === 8) selected @endif>Dès 8 ans</option>
        <option value="7" @if (old('audience', $audience) === 7) selected @endif>Dès 7 ans</option>
        <option value="6" @if (old('audience', $audience) === 6) selected @endif>Dès 6 ans</option>
        <option value="5" @if (old('audience', $audience) === 5) selected @endif>Dès 5 ans</option>
        <option value="4" @if (old('audience', $audience) === 4) selected @endif>Dès 4 ans</option>
        <option value="3" @if (old('audience', $audience) === 3) selected @endif>Dès 3 ans</option>
        <option value="2" @if (old('audience', $audience) === 2) selected @endif>Dès 2 ans</option>
        <option value="1" @if (old('audience', $audience) === 1) selected @endif>Dès 1 an</option>
      </select>
    </div>
  </div>
</div>
