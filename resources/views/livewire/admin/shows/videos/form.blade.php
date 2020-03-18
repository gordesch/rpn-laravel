<div wire:init="loadVideos">
  <x-admin.shows.videos.form :showTitle="$showTitle" :showIsLocalLanguage="$showIsLocalLanguage" :videos="$videos" />
</div>
