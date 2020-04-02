<x-admin.layout title="État des fiches-film"  category="programmings">
  <x-slot name="titleInnerHTML">
    Semaine du {{ $week->start->isoFormat('dddd DD MMMM YYYY') }}
  </x-slot>

  <x-admin.weeks.submenu selected="programmings.shows.edit" :week="$week" />

  <div x-data="modal()" x-show="open" x-on:edit-videos.document="setModal(event)" class="fixed bottom-0 inset-x-0 px-4 z-50 pb-6 sm:inset-0 sm:p-0 sm:flex sm:items-center sm:justify-center">
    <div x-show="open" style="display: none;" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <div x-show="open" style="display: none;" @click.away="closeModal()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-6xl sm:w-full h-screen sm:p-6">
      <iframe x-bind:src="src" class="w-full h-full"></iframe>
    </div>
    <script>
      function modal() {
        return {
          open: false,
          src: '',
          setModal(event) {
            this.open = true;
            this.src = event.detail.src;
          },
          closeModal() {
            this.open = false;
            this.src = '';
            window.livewire.emit('videos-modal-closed');
          }
        }
      }
    </script>
  </div>

  <x-admin.weeks.shows-state.table :shows="$week->programmings->map->show" />
</x-admin.layout>
