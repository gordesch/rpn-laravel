<div class="bg-red-100 border border-red-400 text-red-700 max-w-3xl mx-auto mb-12 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">Aïe !</strong>
  <ul>
    @foreach($errors->all() as $error)
      <li>
        {{ $error }}
      </li>
    @endforeach
  </ul>
</div>
