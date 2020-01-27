@extends('admin.app')

@section('title', "Importation d'une fiche-film")

@section('content')

<form class="form" method="post" action="{{ route('admin.shows.store') }}" enctype="multipart/form-data" role="form" style="padding-top:20px">

    @include('admin.shows._form')
    @include('admin.shows.partials.video-search-containers2')

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
