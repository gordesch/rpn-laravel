<x-admin.auth.layout title="Réinitialisation du mot de passe" category="auth">
  <form action="{{ route('admin.password.email') }}" method="POST" class="bg-white overflow-hidden mt-8 sm:mx-auto sm:w-full sm:max-w-xl shadow sm:rounded-lg">
    @csrf
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Réinitialisation du mot de passe
      </h3>
      <div class="mt-2 max-w-xl text-sm">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
      </div>
      <div class="mt-5 flex flex-col">
        <div class="max-w-xs w-full">
          <x-admin.layout.form.input-text-simple
            name="email"
            label="Votre adresse email"
            type="email"
            autocomplete="email"
            :value="old('email', Request::get('email'))"
            autofocus
            required
            :errors="$errors"
          />
        </div>
      </div>
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
      <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
        <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150 sm:text-sm sm:leading-5">
          M'envoyer le lien de réinitialisation
        </button>
      </span>
    </div>
  </form>
</x-admin.auth.layout>
