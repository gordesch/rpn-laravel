<div class="bg-white shadow overflow-hidden sm:rounded-md max-w-2xl">
  @if(count($shows))
    <ul>
      @foreach($shows as $show)
        <li @if(!$loop->first) class="border-t border-gray-200" @endif>
          <a href="{{ route('admin.shows.edit', [$show]) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
            <div class="flex items-center px-4 py-4 sm:px-6">
              <div class="min-w-0 flex-1 flex items-center">
                <div class="flex-shrink-0">
                  <img class="h-12 w-9 rounded-sm shadow-inner bg-gray-100" src="https://xl.movieposterdb.com/05_08/1999/0185125/xl_43055_0185125_baac3167.jpg" alt="" />
                </div>
                <div class="min-w-0 flex-1 px-4">
                  <div>
                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">{{ $show->title }}</div>
                  </div>
                </div>
              </div>
              <div>
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
              </div>
            </div>
          </a>
        </li>
      @endforeach
    </ul>
  @else
    <a href="#" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
      <div class="flex items-center px-4 py-4 sm:px-6">
        <div class="min-w-0 flex-1 flex items-center">
          <div class="flex-shrink-0">
            <div class="h-12 w-9 rounded-sm bg-transparent">
            </div>
          </div>
          <div class="min-w-0 flex-1 px-4">
            <div>
              <div class="text-sm leading-5 truncate">Aucun résultat.</div>
            </div>
          </div>
        </div>
      </div>
    </a>
  @endif
</div>
