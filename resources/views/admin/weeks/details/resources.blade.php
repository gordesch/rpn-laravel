<x-admin.layout title="Ressources newsletter"  category="programmings">
  <x-slot name="titleInnerHTML">
    Semaine du {{ $week->start->isoFormat('dddd DD MMMM YYYY') }}
  </x-slot>

  <x-admin.weeks.submenu selected="resources" :week="$week"></x-admin.weeks.submenu>

  @foreach($week->programmings as $programming)
    <div class="grid grid-cols-4 gap-4 items-start border-t border-gray-200 @if (!$loop->first) mt-6 sm:mt-5 @endif pt-5">
      <div class="flex items-center">
        <x-admin.shows.poster :show="$programming->show" />
        <h4 class="block ml-5 text-sm font-medium leading-5 text-gray-700 truncate">
          {{ $programming->show->title }}
        </h4>
      </div>
      <div class="self-center mt-1 sm:mt-0 flex rounded-md shadow-sm">
        <x-admin.weeks.resources.infos :programming="$programming" />
      </div>
      <div class="self-center mt-1 sm:mt-0 flex rounded-md shadow-sm">
        <x-admin.weeks.resources.poster :programming="$programming" />
      </div>
      <div class="self-center mt-1 sm:mt-0 flex rounded-md shadow-sm">
        <x-admin.weeks.resources.link :programming="$programming" />
      </div>
    </div>
  @endforeach

  <x-slot name="scripts">
    <script src="https://unpkg.com/clipboard@2.x.x/dist/clipboard.min.js"></script>
    <script>
      //document.querySelectorAll('input').forEach(input => input.addEventListener('click focus', () => input.select()));
      document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('click', () => input.select());
        input.addEventListener('focus', () => input.select());
      });
      new ClipboardJS('.copy-btn');
    </script>
  </x-slot>
</x-admin.layout>
