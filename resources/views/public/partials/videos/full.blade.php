<div class="infosfilm-bandeannonce">
    @foreach($programming->show->videos as $video)
        <button
            class="boutonAffMasqFA btn btn-default"
            data-yt-id="{{ $video->youtube_id }}"
            data-version="{{ $video->is_original_version ? 'VO' : 'VF' }}"
            data-titre="{{ $programming->show->title }}"
        >
            <i class="fa fa-film"></i>
            <span>Regarder</span> la bande-annonce {{ $video->is_original_version ? 'VO' : 'VF' }}
        </button>
    @endforeach
</div>
