<div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
  <fieldset class="mt-6 min-w-full">
    <legend class="text-sm font-medium leading-5 text-gray-700">
      Version française
    </legend>
    <x-admin.videos.search-list :videos="$videos" version="dubbed" />
  </fieldset>
  <fieldset class="mt-6 min-w-full">
    <legend class="text-sm font-medium leading-5 text-gray-700">
      Version originale sous-titrée
    </legend>
    <x-admin.videos.search-list :videos="$videos" version="original" />
  </fieldset>
</div>
