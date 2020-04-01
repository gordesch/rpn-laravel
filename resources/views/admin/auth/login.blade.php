<x-admin.auth.layout title="Connexion">
  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
      <form x-data="{ loggingIn: false, email: null }" @submit="loggingIn = true; $refs.submitButton.innerHTML = '<span class=invisible>Connexion...</span>'" action="{{ route('admin.login') }}" method="POST">
        @csrf
        <x-admin.layout.form.input-text-simple
          name="email"
          label="Adresse email"
          type="email"
          autocomplete="email"
          :placeholder="'adresse@' . config('app.domain')"
          :value="old('email')"
          autofocus
          required
          :errors="$errors"
        />
        <div class="mt-6">
          <x-admin.layout.form.input-text-simple
            name="password"
            label="Mot de passe"
            type="password"
            autocomplete="current-password"
            required
            :errors="$errors"
          />
        </div>

        <div class="mt-6 flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember_me" type="checkbox"
                   class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
              {{ old('remember') ? 'checked' : '' }}
            />
            <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
              Connexion automatique
            </label>
          </div>

          <div class="text-sm leading-5">
            <a href="{{ route('admin.password.request') }}"
               @click="$event.target.href += '?email=' + encodeURI(document.querySelector('#email').value);"
               class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
            >
              Mot de passe oublié ?
            </a>
          </div>
        </div>

        <div class="mt-6">
        <span class="block w-full rounded-md shadow-sm">
          <button type="submit" x-bind:class="{ 'spinner': loggingIn }" x-bind:disabled="loggingIn" x-ref="submitButton"
                  class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 disabled:opacity-75 transition duration-150 ease-in-out">
            Se connecter
          </button>
        </span>
        </div>
      </form>
    </div>
  </div>
</x-admin.auth.layout>
