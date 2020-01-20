@extends('admin.app')

@section('title', "Adaptation des titres simplifiés")

@section('content')

<div class="page-header">
    <h1>Adaptation des titres simplifiés</h1>
</div>

<form method="post" action="{{ route('admin.showings.import.store') }}">
    @csrf

    @if($shows->isEmpty())
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle"></i>
            <strong>Aucune correspondance à créer</strong>,
            tous les films de cette programmation sont déjà importés.
        </div>
    @endif

    @foreach ($shows as $show)
        <input
            type="hidden"
            name="match[{{ $show->ticketing_provider_id }}][ticketing_provider_id]"
            value="{{ $show->ticketing_provider_id }}"
        >
        <div class="form-group has-feedback">
            <label class="control-label" for="{{ $show->ticketing_provider_id }}">
                {{ $show->title }}
            </label>
            <input
                type="text"
                class="film form-control"
                name="match[{{ $show->ticketing_provider_id }}][slug]"
                id="{{ $show->ticketing_provider_id }}"
                title="{{ $show->title }}"
                value="{{ $show->slug }}"
                placeholder="tout-sur-ma-mere"
                size="30"
                maxlength="255"
                required
                v-model="slug"
            >
            <span class="form-control-feedback">
                <i id="ctrlfeedback" class="fa fa-spinner fa-spin"></i>
            </span>
            <span class="help-block" id="slugControl">Vérification en cours...</span>
        </div>
    @endforeach
    <div class="form-actions">
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Importer la programmation" >
    </div>
</form>

@endsection

@section('scripts')
    <script>
        function controlFeedbackExists(element) {
            $(element).next().find('.fa').removeClass('fa-times fa-spin fa-spinner').addClass('fa-check');
            $(element).next().next().text('Correspondance trouvée');
            $(element).parent().removeClass('has-error').addClass('has-success');
        }
        function controlFeedbackNonexistent(element) {
            $(element).next().find('.fa').removeClass('fa-check fa-spin fa-spinner').addClass('fa-times');
            $(element).next().next().html(
                '<span class="help-block">Pas de correspondance : <a '
                + 'href="{{ route('admin.shows.import.search') }}?searched_show='
                + $(element).attr('title')
                + '">créer la fiche-film ?</a></span>'
            );
            $(element).parent().removeClass('has-success').addClass('has-error');
        }
        function controlFeedbackSearch(element) {
            $(element).next().find('.fa').removeClass('fa-check fa-times').addClass('fa-spin fa-spinner');
            $(element).next().next().text('Vérification en cours...');
            $(element).parent().removeClass('has-success').removeClass('has-error');
        }

        function slugCheck(element) {
            controlFeedbackSearch();
            $.get("/api/admin/slug_exists/" + $(element).val(), function(data) {
                if (data === '1'){
                    controlFeedbackExists(element);
                } else {
                    controlFeedbackNonexistent(element);
                }
                return false;
            });
        }

        $('.film').each(function() {
            slugCheck(this);
        });

        $(".film").on('keyup blur', function() {
            slugCheck(this);
        });
    </script>
@endsection
