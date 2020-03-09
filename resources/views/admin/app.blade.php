<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - Interface d'administration</title>

    <link rel="stylesheet" type="text/css" href="/css/admin/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css" integrity="sha256-CCsHNqNAiVDlD9ZaCQkhAD/oPYnsbjCEVJoB1d+p6FQ=" crossorigin="anonymous" />

    <script src="/admin/js/admin-1.2.0.js"></script>
    <script src="/admin/js/tablesorter.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <livewire:styles />

</head>

<body class="bg-gray-100">
<div id="app">
    <!-- Navbar -->
    <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full shadow-sm border border-black" src="/css/admin/rpn-simple.svg" alt="Royal Palace" />
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline">
                            <a href="{{ route('admin.shows.index') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Fiches-film</a>
                            <a href="{{ route('admin.showings.import.index') }}" class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Programmation</a>
                            <a href="#" class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Divers</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 sm:px-3">
                <a href="{{ route('admin.shows.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Fiches-film</a>
                <a href="{{ route('admin.showings.import.index') }}" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Programmation</a>
                <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Divers</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-700">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                        <div class="mt-1 text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                    </div>
                </div>
                <div class="mt-3 px-2">
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Your Profile</a>
                    <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Settings</a>
                    <a href="#" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate border border-transparent">
                        @yield('title')
                    </h2>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    @yield('header-buttons')
                </div>
            </div>
        </div>
    </header>

    <main class="py-6">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</div>

{{--<script src="mix('/js/admin/app.js')"></script>--}}
<livewire:scripts />
@yield('scripts')
</body>

</html>
