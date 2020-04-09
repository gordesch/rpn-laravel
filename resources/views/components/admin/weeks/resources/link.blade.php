@props(['show'])
<div class="flex-grow focus-within:z-10">
  <input id="i_{{ $show->id }}_link" class="form-input block w-full rounded-none rounded-l-md transition ease-in-out duration-150 sm:text-sm sm:leading-5 text-gray-400 bg-gray-50 shadow-inner" value="John Doe" readonly />
</div>
<button data-clipboard-target="#i_{{ $show->id }}_link" class="copy-btn -ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
  <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
    <path fill-rule="evenodd" d="M0,8.00585866 C0,6.89805351 0.897060126,6 2.00585866,6 L11.9941413,6 C13.1019465,6 14,6.89706013 14,8.00585866 L14,17.9941413 C14,19.1019465 13.1029399,20 11.9941413,20 L2.00585866,20 C0.898053512,20 0,19.1029399 0,17.9941413 L0,8.00585866 L0,8.00585866 Z M6,8 L2,8 L2,18 L12,18 L12,14 L15,14 L15,12 L18,12 L18,2 L8,2 L8,5 L6,5 L6,8 L12,8 L12,14 L17.9941413,14 C19.1029399,14 20,13.1019465 20,11.9941413 L20,2.00585866 C20,0.897060126 19.1019465,0 17.9941413,0 L8.00585866,0 C6.89706013,0 6,0.898053512 6,2.00585866 L6,8 Z" clip-rule="evenodd" />
  </svg>
  <label class="ml-2 cursor-pointer" for="i_{{ $show->id }}_link">Lien</label>
</button>
