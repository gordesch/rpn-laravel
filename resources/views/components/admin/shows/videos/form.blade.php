@props(['show', 'showIsLocalLanguage', 'videos'])

<div class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10 @if($showIsLocalLanguage) mx-auto max-w-3xl @endif">
  <h3 class="text-lg leading-6 font-medium text-gray-900">
    @if ($showIsLocalLanguage)
      Bande-annonce
    @else
      Bandes-annonces
    @endif
  </h3>
  <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
    Privilégiez les vidéos publiées par les distributeurs.
  </p>
  <div class="grid grid-cols-1 gap-4 @if ($showIsLocalLanguage) lg:grid-cols-2 @endif">
    <fieldset class="mt-6 min-w-full">
      @if ($showIsLocalLanguage)
        <legend class="text-sm font-medium leading-5 text-gray-700">
          Version française
        </legend>
      @endif
      <x-admin.shows.videos.search-list :videos="$videos" version="dubbed" />
    </fieldset>
    @if ($showIsLocalLanguage)
      <fieldset class="mt-6 min-w-full">
        <legend class="text-sm font-medium leading-5 text-gray-700">
          Version originale sous-titrée
        </legend>
        <x-admin.shows.videos.search-list :videos="$videos" version="original" />
      </fieldset>
    @endunless
  </div>
</div>
