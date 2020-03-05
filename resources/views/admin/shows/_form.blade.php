@csrf

<input
    type="hidden"
    name="shows_provider_id"
    value="{{ old('shows_provider_id', $show->shows_provider_id) }}"
>

<x-admin.layout.form.input-text
    name="title"
    title="Titre"
    :oldValue="$show->title"
    attrs="maxlength='255' required autofocus"
    state=""
/>

<slug-check id="slug" label="Titre simplifé" name="slug" v-bind:shouldexist="false" value="{{ old('slug', $show->slug) }}"></slug-check>

<div class="form-group has-feedback {{ $show->poster_url ? 'has-success' : 'has-warning' }}">
    <label for="poster_url" class="control-label">Affiche</label><br/>
    <input
        class="form-control"
        id="poster_url"
        name="poster_url"
        size="30"
        type="text"
        value="{{ old('poster_url', $show->poster_url ?? '') }}"
    />
    @if ($show->poster_url)
        <span class="form-control-feedback">
            <i id="ctrlfeedback" class="fa fa-check"></i>
        </span>
    @endif
    <img
        src="{{ old('poster_url', $show->poster_url ?? '') }}"
        alt=""
        width="115"
        height="150"
        class="thumbnail"
        style="margin-top: 10px;"
    />
</div>

<x-admin.layout.form.input-text
    name="year"
    title="Année"
    :oldValue="$show->year"
    attrs="maxlength='255' required autofocus"
    state="{{ $show->year ? 'success' : 'warning' }}"
/>
<div class="form-group has-feedback  {{ $show->year ? 'has-success' : 'has-warning' }}">
    <label for="year" class="control-label">Année</label>
    <input
        type="text"
        name="year"
        id="year"
        class="form-control"
        size="30"
        maxlength="255"
        value="{{ old('year', $show->year) }}"
    />
    @if ($show->year)
        <span class="form-control-feedback">
            <i class="fa fa-check"></i>
        </span>
    @endif
</div>

<div class="form-group {{ $show->duration_in_seconds ? 'has-success' : 'has-warning' }}">
    <label class="control-label">Durée</label><br/>
    <div class="row">
        <div class="col-md-2">
            <div class="input-group">
                <input
                    type="text"
                    name="hours"
                    class="form-control"
                    size="3"
                    maxlength="2"
                    value="{{ old('hours', $show->duration->format('%h')) }}"
                />
                <span class="input-group-addon">h</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <input
                    type="text"
                    name="minutes"
                    class="form-control"
                    size="4"
                    maxlength="2"
                    value="{{ old('minutes', $show->duration->format('%I')) }}"
                />
                <span class="input-group-addon">min</span>
            </div>
        </div>
    </div>
</div>

<div class="form-group has-feedback {{ $show->director ? 'has-success' : 'has-warning' }}">
    <label for="director" class="control-label">Réalisateur</label>
    <input
        type="text"
        name="director"
        id="director"
        class="form-control"
        size="30"
        maxlength="255"
        value="{{ old('director', $show->director) }}"
    />
    @if ($show->director)
        <span class="form-control-feedback">
            <i class="fa fa-check"></i>
        </span>
    @endif
</div>

<div class="form-group has-feedback {{ $show->cast ? 'has-success' : 'has-warning' }}">
    <label for="cast" class="control-label">Casting</label>
    <input
        type="text"
        name="cast"
        id="cast"
        class="form-control"
        size="30"
        maxlength="255"
        value="{{ old('cast', $show->cast) }}"
    />
    @if ($show->cast)
        <span class="form-control-feedback">
            <i class="fa fa-check"></i>
        </span>
    @endif
</div>

<div class="form-group has-feedback {{ $show->genre ? 'has-success' : 'has-warning' }}">
    <label for="genre" class="control-label">Genre</label>
    <input
        type="text"
        name="genre"
        id="genre"
        class="form-control"
        size="30"
        maxlength="255"
        value="{{ old('genre', $show->genre) }}"
    />
    @if ($show->genre)
        <span class="form-control-feedback">
            <i class="fa fa-check"></i>
        </span>
    @endif
</div>

<div class="form-group has-feedback {{ $show->country ? 'has-success' : 'has-warning' }}">
    <label for="country" class="control-label">Pays</label>
    <input
        type="text"
        name="country"
        id="country"
        class="form-control"
        size="30"
        maxlength="255"
        value="{{ old('country', $show->country) }}"
    />
    @if ($show->country)
        <span class="form-control-feedback">
            <i class="fa fa-check"></i>
        </span>
    @endif
</div>

<div class="form-group has-feedback {{ $show->synopsis ? 'has-success': 'has-warning' }}">
    <label for="synopsis" class="control-label">Synopsis</label>
    <textarea name="synopsis" id="synopsis" class="form-control">{{ nl2br($show->synopsis) }}</textarea>
</div>

<div class="form-group {{ $show->audience ? 'has-success' : '' }}">
    <label for="age" class="control-label">Âge</label>
    <div class="row">
        <div class="col-md-3">
            <div class="input-group">
                <input
                    type="text"
                    name="age"
                    id="age"
                    class="form-control"
                    size="6"
                    maxlength="2"
                    value="{{ old('audience', $show->audience) }}"
                />
                <span class="input-group-addon">ans</span>
            </div>
        </div>
    </div>
    <span class="help-block">"Interdit aux moins de...", ou "À partir de...". Pour un avertissement, taper "av"</span>
</div>
