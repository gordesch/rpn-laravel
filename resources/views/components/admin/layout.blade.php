<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ $title }} - Interface d'administration</title>

  <link rel="stylesheet" type="text/css" href="{{ mix('/css/admin/admin.css') }}">
  <livewire:styles />
</head>

<body class="bg-gray-100">
<div id="app">
  <!-- Navbar -->
  <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center w-full">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full shadow-sm border border-black" src="/css/admin/rpn-simple.svg" alt="Royal Palace" />
          </div>
          <div class="block overflow-y-scroll whitespace-no-wrap">
            <div class="ml-2 sm:ml-10 flex items-baseline">
              <x-admin.layout.menu.link :href="route('admin.shows.index')" linkCategory="shows" :category="$category">
                Fiches-film
              </x-admin.layout.menu.link>
              <x-admin.layout.menu.link :href="route('admin.weeks.index')" linkCategory="programmings" class="ml-4" :category="$category">
                Programmations
              </x-admin.layout.menu.link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="flex items-center max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
      <div class="w-full md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
          <h1 class="text-lg font-bold leading-9 text-gray-900 sm:text-xl sm:truncate border border-transparent">
            {{ $titleInnerHTML ?? $title }}
          </h1>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
          {{ $headerButtons ?? null }}
        </div>
      </div>
    </div>
  </header>

  <main class="py-6">

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

      @if ($errors->any())
        <x-admin.layout.alerts.errors />
      @endif

      @foreach (session('flash_notification', collect())->toArray() as $message)
        <x-admin.layout.alerts.alert :message="$message"/>
      @endforeach

      {{ $slot }}
    </div>
  </main>
</div>

<script src="{{ mix('/js/admin/admin.js') }}" defer></script>
<livewire:scripts />
{{ $scripts ?? null }}

</body>

</html>
