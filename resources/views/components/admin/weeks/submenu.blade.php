@props(['selected', 'week'])
<div class="mb-8">
  <div class="sm:hidden">
    <select class="form-select block w-full">
      <option @if($selected === 'tuning') selected @endif>Réglages</option>
      <option @if($selected === 'shows-state') selected @endif>État des fiches</option>
      <option @if($selected === 'resources') selected @endif>Ressources newsletter</option>
      <option @if($selected === 'showings') selected @endif>Séances</option>
    </select>
  </div>
  <div class="hidden sm:block">
    <div class="border-b-2 border-gray-300">
      <nav class="flex -mb-px">
        <a href="{{ route('admin.weeks.edit', [$week]) }}" class="@if($selected === 'tuning') border-indigo-500 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 @endif ml-8 group inline-flex items-center -mb-px py-4 px-1 border-b-4 font-medium text-sm leading-5">
          <svg class="-ml-0.5 mr-2 h-5 w-5 @if($selected === 'tuning') text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M9.42239525,7.09396812 C10.2387498,5.25806681 9.89409813,3.03105216 8.38844025,1.52539428 C6.93864576,0.0755997864 4.82002948,-0.297742297 3.02577331,0.40536803 L6.97422669,4.35382141 L4.14579956,7.18224853 L0.197346187,3.23379515 C-0.50576414,5.02805132 -0.132422056,7.1466676 1.31737244,8.59646209 C2.70997507,9.98906472 4.71967257,10.3884681 6.46624524,9.79467236 L16.5961941,19.9246212 L19.4246212,17.0961941 L9.42239525,7.09396812 Z" clip-rule="evenodd"/>
          </svg>
          <span>Réglages</span>
        </a>
        <a href="{{ route('admin.weeks.shows-state', [$week]) }}" class="@if($selected === 'shows-state') border-indigo-500 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 @endif ml-8 group inline-flex items-center -mb-px py-4 px-1 border-b-4 font-medium text-sm leading-5">
          <svg class="-ml-0.5 mr-2 h-5 w-5 @if($selected === 'shows-state') text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M11.9321237,9.48208981 C12.110309,10.1493234 11.9376722,10.8907549 11.4142136,11.4142136 C10.633165,12.1952621 9.36683502,12.1952621 8.58578644,11.4142136 C7.80473785,10.633165 7.80473785,9.36683502 8.58578644,8.58578644 C9.10924511,8.06232776 9.8506766,7.88969103 10.5179102,8.06787625 L13.5355339,5.05025253 L14.9497475,6.46446609 L11.9321237,9.48208981 Z M15.5995658,15.7135719 C17.0809102,14.261603 18,12.238134 18,10 C18,5.581722 14.418278,2 10,2 C5.581722,2 2,5.581722 2,10 C2,12.238134 2.91908983,14.261603 4.40043425,15.7135719 C5.99810554,14.63183 7.92526686,14 10,14 C12.0747331,14 14.0018945,14.63183 15.5995658,15.7135719 Z M10,20 C15.5228475,20 20,15.5228475 20,10 C20,4.4771525 15.5228475,0 10,0 C4.4771525,0 0,4.4771525 0,10 C0,15.5228475 4.4771525,20 10,20 Z" clip-rule="evenodd"/>
          </svg>
          <span>
            État des fiches-film
          </span>
          <span class="inline-flex items-center ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 @if($selected === 'shows-state')  bg-indigo-200 text-indigo-500 @else bg-gray-200 text-gray-500 @endif">
            <svg class="h-4 w-4 @if($selected === 'shows-state') text-indigo-400 @else text-gray-400 @endif" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8.25706 3.09882C9.02167 1.73952 10.9788 1.73952 11.7434 3.09882L17.3237 13.0194C18.0736 14.3526 17.1102 15.9999 15.5805 15.9999H4.4199C2.89025 15.9999 1.92682 14.3526 2.67675 13.0194L8.25706 3.09882ZM11.0001 13C11.0001 13.5523 10.5524 14 10.0001 14C9.44784 14 9.00012 13.5523 9.00012 13C9.00012 12.4477 9.44784 12 10.0001 12C10.5524 12 11.0001 12.4477 11.0001 13ZM10.0001 5C9.44784 5 9.00012 5.44772 9.00012 6V9C9.00012 9.55228 9.44784 10 10.0001 10C10.5524 10 11.0001 9.55228 11.0001 9V6C11.0001 5.44772 10.5524 5 10.0001 5Z" clip-rule="evenodd"></path>
            </svg>
            {{ $week->shows_with_missing_data->count() }}
          </span>
        </a>
        <a href="{{ route('admin.weeks.resources', [$week]) }}" class="@if($selected === 'resources') border-indigo-500 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 @endif ml-8 group inline-flex items-center -mb-px py-4 px-1 border-b-4 font-medium text-sm leading-5">
          <svg class="-ml-0.5 mr-2 h-5 w-5 @if($selected === 'resources') text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3,6 L3,5.99810135 C3,4.89458045 3.89706013,4 5.00585866,4 L13,4 L17,0 L19,0 L19,16 L17,16 L13,12 L5.00585866,12 C3.89805351,12 3,11.1132936 3,10.0018986 L3,10 L1,10 L1,6 L3,6 Z M11,15 L13,15 L13,13 L5,13 L5,15 L6.33333333,15 L8,20 L11,20 L11,15 Z" clip-rule="evenodd"/>
          </svg>
          <span>Ressources newsletter</span>
        </a>
        <a href="#" class="@if($selected === 'showings') border-indigo-500 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 @endif ml-8 group inline-flex items-center -mb-px py-4 px-1 border-b-4 font-medium text-sm leading-5">
          <svg class="-ml-0.5 mr-2 h-5 w-5 @if($selected === 'showings') text-indigo-500 @else text-gray-400 group-hover:text-gray-500 @endif" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M20,12 L20,17 L0,17 L0,12 C1.1045695,12 2,11.1045695 2,10 C2,8.8954305 1.1045695,8 0,8 L0,3 L20,3 L20,8 C18.8954305,8 18,8.8954305 18,10 C18,11.1045695 18.8954305,12 20,12 Z M3,5 L17,5 L17,15 L3,15 L3,5 Z M10,12.0831427 L7.07572273,14.118034 L8.10736797,10.7080651 L5.26841999,8.55572809 L8.83028908,8.48314266 L10,5.11803399 L11.1697109,8.48314266 L14.73158,8.55572809 L11.892632,10.7080651 L12.9242773,14.118034 L10,12.0831427 Z" clip-rule="evenodd"/>
          </svg>
          <span>Séances</span>
        </a>
      </nav>
    </div>
  </div>
</div>
