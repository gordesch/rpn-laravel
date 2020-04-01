<x-admin.auth.layout title="Vérification de votre adresse email" category="auth">
  <div action="{{ route('admin.password.update') }}" method="POST" class="bg-white overflow-hidden mt-8 sm:mx-auto sm:w-full sm:max-w-xl shadow sm:rounded-lg">
    @csrf
    <div class="flex items-center bg-white px-4 py-5 sm:p-6">
      <div class="w-1/4">
        <img class="h-auto w-full border border-gray-300 rounded-sm shadow-inner bg-gray-100 opacity-75" src="/css/admin/stop-schwarznenegger.jpeg" style="filter: grayscale(40%)">
      </div>
      <div class="ml-6 mt-0">
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
