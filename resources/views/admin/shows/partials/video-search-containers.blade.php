<div class="row">
    <div id="video_dubbed" class="col-md-6">
        <div class="form-group has-warning">
            <label for="video-dubbed" class="control-label">Bande-annonce VF</label>
            <div id="video-dubbed" class="btn-group-vertical" data-toggle="buttons">
                <label class="btn btn-warning active" style="text-align: center;">
                    <input type="radio" value="" name="video-dubbed">Ne pas afficher de bande-annonce
                </label>
            </div>
        </div>
    </div>
    <div id="vost" class="col-md-6">
        <div class="form-group has-warning">
            <label for="video-original" class="control-label">Bande-annonce VOST</label>
            <div id="video-original" class="btn-group-vertical" data-toggle="buttons">
                <label class="btn btn-warning active" style="text-align: center;">
                    <input type="radio" value="" name="video-original">Ne pas afficher de bande-annonce
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
            formatResults('video-dubbed', response);
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
            formatResults('video-original', response);
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
