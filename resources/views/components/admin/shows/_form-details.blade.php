<x-admin.layout.form.poster-upload :show="$show" />

<x-admin.layout.form.input-text
    name="year"
    title="Année"
    :value="$show->year"
    attrs="maxlength=4"
    width="6"
    state="{{ $show->year ? 'success' : 'warning' }}"
/>

<x-admin.layout.form.input-duration
  :hours="$show->duration ? $show->duration->format('%h') : null"
  :minutes="$show->duration ? $show->duration->format('%I') : null"
/>

<x-admin.layout.form.input-text
    name="director"
    title="Réalisation"
    :value="$show->director"
    attrs="maxlength=255"
    width="xs"
    state="{{ $show->director ? 'success' : 'warning' }}"
/>

<x-admin.layout.form.input-text
    name="cast"
    title="Casting"
    :value="$show->cast"
    attrs="maxlength=255"
    width="lg"
    state="{{ $show->cast ? 'success' : 'warning' }}"
/>

<x-admin.layout.form.input-text
    name="genre"
    title="Genre"
    :value="$show->genre"
    attrs="maxlength=255"
    width="xs"
    state="{{ $show->genre ? 'success' : 'warning' }}"
/>

<x-admin.layout.form.input-text
    name="country"
    title="Pays"
    :value="$show->country"
    attrs="maxlength=255"
    width="xs"
    state="{{ $show->country ? 'success' : 'warning' }}"
/>

<x-admin.layout.form.textarea
    name="synopsis"
    title="Synopsis"
    :value="nl2br($show->synopsis)"
    attrs="rows=5"
    state="{{ $show->synopsis ? 'success' : 'warning' }}"
/>

<x-admin.layout.form.select-age :audience="$show->audience" />
