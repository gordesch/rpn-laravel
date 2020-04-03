<x-admin.auth.layout title="Vérification de votre adresse email" category="auth">
  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    @csrf
    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
      <div class="relative group" tabindex="0">
        <img
          src="/css/admin/verify-moonrise-kingdom.jpg"
          srcset="/css/admin/verify-moonrise-kingdom@2x.jpg 2x"
          class="w-full h-auto"
        >
        <p class="absolute bottom-0 right-0 bg-black px-2 py-1 m-1 text-xs text-white leading-none opacity-0 group-hover:opacity-100 group-focus:opacity-100">
          Moonrise Kingdom &ndash; Wes Anderson &ndash; 2012 &ndash; Studiocanal
        </p>
      </div>
      <div class="py-8 px-4 sm:px-10">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          Vérification de votre adresse email
        </h3>
        <div class="mt-2 max-w-xl text-sm">
          @if (session('resent'))
            <div class="alert alert-success" role="alert">
              Un nouveau lien de vérification vous a été envoyé par email.
            </div>
          @endif
        </div>
        <div class="mt-2 max-w-xl text-sm leading-5 text-gray-500">
          Avant de continuer, merci de vérifier votre email à l'aide du lien qui vous a été envoyé.
          Si vous ne l'avez pas reçu,
          <form class="inline" method="POST" action="{{ route('admin.verification.resend') }}">
            @csrf
            <button type="submit" class="font-medium text-gray-700 hover:text-gray-500 hover:underline transition ease-in-out duration-150">cliquez ici pour le renvoyer</button>.
          </form>
        </div>
      </div>
    </div>
  </div>
</x-admin.auth.layout>
