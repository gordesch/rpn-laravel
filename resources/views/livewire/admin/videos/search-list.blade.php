<div>
  <div class="bg-white shadow overflow-hidden sm:rounded-md max-w-3xl mx-auto">
    <ul>
      <li>
        <label class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
          <div class="flex px-4 py-4 sm:px-6 text-center text-sm leading-5">
            <input type="radio" value="" name="video-dubbed">Ne pas afficher de bande-annonce
          </div>
        </label>
      </li>
      @foreach($videos['dubbed_version'] as $video)
        <li class="border-t border-gray-200">
          <label class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
            <div class="flex items-center px-4 py-4 sm:px-6">
              <div class="min-w-0 flex-1 flex items-center">
                <div class="flex-shrink-0">
                  <img
                      class="h-12 w-12 border border-gray-300 rounded-sm shadow-inner bg-gray-100"
                      src="{{ $video->snippet->thumbnails->default->url }}"
                      alt=""
                  />
                </div>
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                  <div>
                    <div class="text-sm leading-5 font-medium text-indigo-600 truncate">
                      {!! strip_tags($video->snippet->title) !!}
                    </div>
                    <div class="mt-2 flex items-center text-sm leading-5 text-gray-500">
                      de {{ $video->snippet->channelTitle }}
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
              </div>
            </div>
          </label>
        </li>
      @endforeach
    </ul>
  </div>
</div>
