@props(['title', 'onlyTitle'])
<x-admin.layout :title="$title" category="auth">
  <div class="@if(!Auth::user() ?? Auth::user()->email_verified_at) min-h-screen @endif flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      @if(!Auth::user() ?? Auth::user()->email_verified_at)
        <img class="mx-auto h-32 w-auto" src="/css/logo-texte.svg" alt="Cinéma Royal Palace"/>
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
          {{ isset($onlyTitle) ? $title : "Interface d'administration" }}
        </h2>
      @endif
    </div>

    {{ $slot }}

  </div>
</x-admin.layout>
