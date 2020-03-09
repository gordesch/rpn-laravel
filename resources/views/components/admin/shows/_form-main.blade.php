<input
  type="hidden"
  name="shows_provider_id"
  value="{{ old('shows_provider_id', $show->shows_provider_id) }}"
>

<x-admin.layout.form.input-text
  name="title"
  title="Titre"
  :value="$show->title"
  attrs="maxlength=255 required autofocus"
  width="md"
  state="{{ $show->title ? 'success' : 'warning' }}"
/>

<livewire:admin.shows.slug-check
  name="slug"
  title="Titre simplifié"
  :shouldExist="$slugShouldExist"
  :value="$show->slug"
  :show="$show"
  width="md"
/>
