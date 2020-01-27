<div class="row">
    <div id="video_dubbed" class="col-md-6">
        <div class="form-group has-warning">
            <label for="video-dubbed" class="control-label">Bande-annonce VF</label>
            <div id="video-dubbed" class="btn-group-vertical" data-toggle="buttons">
                <label class="btn btn-warning active" style="text-align: center;">
                    <input type="radio" value="" name="video-dubbed">Ne pas afficher de bande-annonce
                </label>
                @foreach($videos['dubbed_version'] as $video)
                    <label class="btn btn-default">
                        <input
                            name="video-dubbed"
                            type="radio"
                            value="{{ $video->id->videoId }}"
                            class="video-radio-input"
                        >
                        <div class="media">
                            <div class="media-left">
                                <img
                                    class="media-object"
                                    src="{{ $video->snippet->thumbnails->default->url }}"
                                    alt=""
                                >
                            </div>
                            <div class="media-body" style="vertical-align:middle;">
                                {!! strip_tags($video->snippet->title) !!}<br>
                                <small>de <em>{{ $video->snippet->channelTitle }}</em></small>
                            </div>
                        </div>
                    </label>
                @endforeach
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
                @foreach($videos['original_version'] as $video)
                    <label class="btn btn-default">
                        <input
                            name="video-original"
                            type="radio"
                            value="{{ $video->id->videoId }}"
                            class="video-radio-input"
                        >
                        <div class="media">
                            <div class="media-left">
                                <img
                                    class="media-object"
                                    src="{{ $video->snippet->thumbnails->default->url }}"
                                    alt=""
                                >
                            </div>
                            <div class="media-body" style="vertical-align:middle;">
                                {!! strip_tags($video->snippet->title) !!}<br>
                                <small>de <em>{{ $video->snippet->channelTitle }}</em></small>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>
