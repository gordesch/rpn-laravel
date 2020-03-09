<div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md max-w-full mx-auto">
  <ul>
    <li class="border-t border-gray-200">
      <label class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out cursor-pointer">
        <div class="flex items-center px-4 py-4 sm:px-6">
          <div class="min-w-0 flex-1 flex items-center">
            <div class="min-w-0 flex-1 pr-4 text-sm text-gray-500 leading-5 truncate">
              Ne pas afficher de bande-annonce
            </div>
          </div>
          <div>
            <input
                name="video-{{ $version }}"
                type="radio"
                value=""
                class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out"
                checked
            >
          </div>
        </div>
      </label>
    </li>
    @foreach($videos[$version . '_version'] as $video)
      <li class="border-t border-gray-200">
        <label class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out cursor-pointer">
          <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="min-w-0 flex-1 flex items-center">
              <div class="flex-shrink-0">
                <img
                    class="h-9 w-12 border border-gray-300 rounded-sm shadow-inner bg-gray-100"
                    src="{{ $video->snippet->thumbnails->default->url }}"
                    alt=""
                />
              </div>
              <div class="min-w-0 flex-1 px-4 text-sm text-gray-500 leading-5">
                <div>
                  <div class="font-medium truncate">
                    {!! strip_tags($video->snippet->title) !!}
                  </div>
                  <div class="mt-2 truncate">
                    de {{ $video->snippet->channelTitle }}
                  </div>
                </div>
              </div>
            </div>
            <div>
              <input
                  name="video-{{ $version }}"
                  type="radio"
                  value="{{ $video->id->videoId }}"
                  class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out"
              >
            </div>
          </div>
        </label>
      </li>
    @endforeach
  </ul>
</div>
