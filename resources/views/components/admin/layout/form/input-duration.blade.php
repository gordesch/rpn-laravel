<div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
  <label for="hours" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
    Durée
  </label>
  <div class="flex mt-1 sm:mt-0 sm:col-span-2">
    <div class="w-20 mr-3 rounded-md shadow-sm relative">
      <input
        id="hours"
        name="hours"
        class="form-input block w-full pr-8 sm:pr-6 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
        value="{{ old('hours', $hours) }}"
        type="text"
      />
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5">
          h
        </span>
      </div>
    </div>
    <div class="w-20 rounded-md shadow-sm relative">
      <input
          id="minutes"
          name="minutes"
          class="form-input block w-full pr-12 sm:pr-10 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          value="{{ old('minutes', $minutes) }}"
          type="text"
      />
      <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5">
          min
        </span>
      </div>
    </div>
  </div>
</div>
