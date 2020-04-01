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
  @auth
  <!-- Navbar -->
  <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
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
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <button class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
          <div @click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
            <div>
              <button @click="open = !open" class="flex text-sm border-2 border-transparent text-gray-500 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">
                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10ZM12 7C12 8.10457 11.1046 9 10 9C8.89543 9 8 8.10457 8 7C8 5.89543 8.89543 5 10 5C11.1046 5 12 5.89543 12 7ZM9.99993 11C7.98239 11 6.24394 12.195 5.45374 13.9157C6.55403 15.192 8.18265 16 9.99998 16C11.8173 16 13.4459 15.1921 14.5462 13.9158C13.756 12.195 12.0175 11 9.99993 11Z" />
                </svg>
              </button>
            </div>
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg z-40">
              <div class="py-1 rounded-md bg-white shadow-xs">
                <div class="px-4 py-3">
                  <p class="text-sm leading-5">
                    Connecté comme
                  </p>
                  <p class="text-sm leading-5 font-medium text-gray-900">
                    {{ Auth::user()->username }}
                  </p>
                </div>
                <div class="border-t border-gray-100"></div>
                <div class="py-1">
                  <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Profil</a>
                  <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Paramètres</a>
                </div>
                <div class="border-t border-gray-100"></div>
                <div class="py-1">
                  <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Déconnexion</a>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-white shadow sticky top-0 z-30">
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
  @endauth
      {{ $slot }}
  @auth
    </div>
  </main>
  @endauth
</div>

<script src="{{ mix('/js/admin/admin.js') }}" defer></script>
<livewire:scripts />
{{ $scripts ?? null }}

</body>

</html>
