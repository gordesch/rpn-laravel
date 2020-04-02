<x-admin.auth.layout title="Connexion" :onlyTitle="true">
  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white shadow sm:rounded-lg overflow-hidden">
      <div class="relative group" tabindex="0">
        <img
          src="/css/admin/login-fifth-element.jpg"
          src="/css/admin/login-fifth-element.jpg"
          srcset="/css/admin/login-fifth-element@2x.jpg 2x, /css/admin/login-fifth-element@original.jpg 3x"
          class="w-full h-auto"
          style="filter: brightness(1.6) contrast(.8) grayscale(.6);"
        >
        <p class="absolute bottom-0 right-0 bg-black px-2 py-1 m-1 text-xs text-white leading-none opacity-0 group-hover:opacity-100 group-focus:opacity-100">
          Le Cinquième élément &ndash; Luc Besson &ndash; 1997 &ndash; Gaumont
        </p>
      </div>
      <form
        x-data="{ loggingIn: false, email: null }"
        @submit="loggingIn = true; $refs.submitButton.innerHTML = '<span class=invisible>Connexion...</span>'"
        action="{{ route('admin.login') }}"
        method="POST"
        class="py-8 px-4 sm:px-10"
      >
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
