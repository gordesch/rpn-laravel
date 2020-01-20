@extends('admin.app')

@section('title', "Importation d'une fiche-film")

@section('content')

<form class="form" method="post" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data" role="form" style="padding-top:20px">

    @include('admin.shows._form')

    <div class="row">
        <div id="video_dubbed" class="col-md-6">
            <div class="form-group has-warning">
                <label for="fa-vf" class="control-label">Bande-annonce VF</label>
                <div id="search-container-dubbed" class="btn-group-vertical" data-toggle="buttons">
                    <label class="btn btn-warning active" style="text-align: center;">
                        <input type="radio" value="" name="search-container-vf">Ne pas afficher de bande-annonce
                    </label>
                </div>
            </div>
        </div>
        <div id="vost" class="col-md-6">
            <div class="form-group has-warning">
                <label for="video_original" class="control-label">Bande-annonce VOST</label>
                <div id="search-container-original" class="btn-group-vertical" data-toggle="buttons">
                    <label class="btn btn-warning active" style="text-align: center;">
                        <input type="radio" value="" name="search-container-vf">Ne pas afficher de bande-annonce
                    </label>
                </div>
            </div>
        </div>
    </div>


    <script>
        function init() {
            gapi.client.setApiKey('AIzaSyDJyEdvOHlXM9IwXBzeCos62Kkwq0EYcSo');
            gapi.client.load('youtube', 'v3', function() {
                search();
            });
        }

        // Search for a specified string.
        function search() {
            var q, request;

            // Bande annonce VF
            q = "bande annonce vf " + $('#title').val();
            request = gapi.client.youtube.search.list({
                q: q,
                part: 'id,snippet',
                maxResults: '5',
                type: 'video',
                videoEmbeddable: 'true'
            });

            request.execute(function(response) {
                formatResults('search-container-dubbed', response);
            });

            // Bande-annonce VOST
            q = "bande annonce vost " + $('#title').val();
            request = gapi.client.youtube.search.list({
                q: q,
                part: 'id,snippet',
                maxResults: '5',
                type: 'video',
                videoEmbeddable: 'true'
            });

            request.execute(function(response) {
                formatResults('search-container-original', response);
            });
        }

        function formatResults(targetDiv, json){
            var div = $('#' + targetDiv), responseLength = json.items.length, noTrailer;
            $('#' + targetDiv).empty();
            for (var i = 0; i < responseLength; i++) {
                var entry = json.items[i], label = document.createElement('label');
                label.className = 'btn btn-default';
                label.innerHTML =
                    '<input '
                    +   'name="' + targetDiv + '" '
                    +   'type="radio"'
                    +   'value="' + entry.id.videoId + '" '
                    +   'onchange="changeWarning();">'
                    +'<div class="media">'
                    +   '<div class="media-left">'
                    +       '<img '
                    +           'class="media-object" '
                    +           'src="' + entry.snippet.thumbnails.default.url + '" '
                    +           'alt="">'
                    +   '</div>'
                    +   '<div class="media-body" style="vertical-align:middle;">'
                    +       entry.snippet.title
                    +       '<br/><small>de <em>' + entry.snippet.channelTitle + '</strong></em>'
                    +   '</div>'
                '</div>'
                div.append(label);
            }
            noTrailer = document.createElement('label');
            noTrailer.className = 'btn btn-warning active notrailer';
            noTrailer.setAttribute('checked', true);
            noTrailer.setAttribute('style', 'text-align:center;')
            noTrailer.innerHTML =
                '<input '
                +   'name="' + targetDiv + '" '
                +   'type="radio"'
                +   'value="">'
                +'Ne pas afficher de bande-annonce';
            div.append(noTrailer);
        }
        function changeWarning(){
            $(this).parent().removeClass('btn-default').addClass('btn-success');
            $(this).parent().parent().parent().removeClass('has-warning').addClass('has-success');
        }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=init"></script>

    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Créer la fiche-film" />
</form>

<script>
    function controlFeedbackError(){
        $("#ctrlfeedback").removeClass('fa-check fa-spin fa-spinner').addClass('fa-times');
        $("#slugControl").fadeOut('fast', function() {
            $(this).text('Ce titre simplifié est déjà utilisé, il faut le modifier').fadeIn('fast');
        });
        $("#slugControl").parent().removeClass('has-success').removeClass('has-error').addClass('has-error');
    }
    function controlFeedbackSuccess(){
        $("#ctrlfeedback").removeClass('fa-times fa-spin fa-spinner').addClass('fa-check');
        $("#slugControl").fadeOut('fast', function() {
            $(this).text('Ce titre simplifié est disponible').fadeIn('fast');
        });
        $("#slugControl").parent().removeClass('has-success').removeClass('has-error').addClass('has-success');
    }
    function controlFeedbackSearch(){
        $("#ctrlfeedback").removeClass('fa-check fa-times').addClass('fa-spin fa-spinner');
        $("#slugControl").fadeOut('fast', function() {
            $(this).text('').fadeIn('fast');
        });
        $("#slugControl").parent().removeClass('has-success').removeClass('has-error');
    }

    function slugCheck(){
        controlFeedbackSearch();
        $.get("check-film.php" ,{ film:$("#film").val() } ,function(data){
            if(data=='no'){
                controlFeedbackError();
                $("input[type=submit]").prop('disabled', true);
            }else{
                controlFeedbackSuccess();
                $("input[type=submit]").prop('disabled', false);
            }
            return false;
        });
    }

    $(document).ready(function(){
        slugCheck();
    });

    $("#title").blur(function(){
        slugCheck();
    });

    $("#cast").blur(function(){
        if(this.value){
            var casting = $(this).val();
            var patt1 = /, /;
            if(patt1.test(casting) == true){
                casting = casting.split(', ');
                var patt = / et /;
                for (var i = 1; i < casting.length-1; i++) {
                    casting[i] = ', ' + casting[i];
                }
                if(patt.test(casting[casting.length-1]) == false){
                    casting[casting.length-1] = ' et ' + casting[casting.length-1];
                    var castingnew = casting.join('');
                    $(this).val(castingnew);
                }
            }
        }
    });

    $("input[name=hours]").keyup(function(){
        if($(this).val().length >= 1){
            $("input[name=minutes]").focus();
            $("input[name=minutes]").val('');
        }
    });

    $("input[name=hours]").click(function(){
        $(this).val('');
    });
    $("input[name=minutes]").click(function(){
        $(this).val('');
    });

    $("input").blur(function(){
        $(this).val($.trim($(this).val()));
    });
</script>

@endsection
