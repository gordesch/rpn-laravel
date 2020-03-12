@csrf

<div class="mx-auto max-w-3xl">
  <x-admin.shows._form-main :show="$show" :slugShouldExist="$slugShouldExist" :mode="$mode"/>
  <x-admin.shows._form-details :show="$show" />
</div>

