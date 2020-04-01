<x-admin.auth.layout title="Confirmation du mot de passe" category="auth">
  <form action="{{ route('admin.password.confirm') }}" method="POST" class="bg-white overflow-hidden mt-8 sm:mx-auto sm:w-full sm:max-w-xl shadow sm:rounded-lg">
    @csrf
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Confirmation du mot de passe
      </h3>
      <div class="mt-2 max-w-xl text-sm leading-5 text-gray-500">
        <p>
          Nous avons besoin de confirmer votre mot de passe avant de continuer.
        </p>
      </div>
      <div class="mt-5 flex flex-col">
        <div class="max-w-xs w-full">
          <x-admin.layout.form.input-text-simple
            name="password"
            label="Votre mot de passe"
            type="password"
            autocomplete="current-password"
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
          Confirmer le mot de passe
        </button>
      </span>
      @if (Route::has('admin.password.request'))
        <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
          <a href="{{ route('admin.password.request') }}" class="inline-flex justify-center w-full border border-transparent px-4 py-2 text-base leading-6 font-medium text-gray-700 hover:text-gray-500 hover:underline transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Mot de passe oublié ?
          </a>
        </span>
      @endif
    </div>
  </form>
</x-admin.auth.layout>
