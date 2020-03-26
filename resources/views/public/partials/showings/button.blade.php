@if (config('app.online_ticketing.open')
    && ($showing->datetime > \Gordesch\CineCarbon::now()->modify(config('app.online_ticketing.stop_selling_at')))
)
    <a
        href="{{ config('app.online_ticketing.base_url') }}{{ $showing->ticketing_provider_id }}"
        class="btn btn-sm btn-default buyticket-btn" role="button">
        <i class="fa fa-ticket"></i>
@else
    <span class="btn btn-sm btn-default buyticket-btn disabled">
@endif
    <time datetime="{{ $showing->datetime->toIso8601String() }}">
        {{ $showing->datetime->format('H:i') }}
    </time>
    @if ($showing->is_original_version)
        <abbr title="Version originale sous-titrée en français" class="label label-primary">VOST</abbr>
    @endif
    @if ($showing->is_3d)
        <abbr title="Projection en relief stéréoscopique" class="label label-danger">3D</abbr>
    @endif
@if (!config('app.online_ticketing.open')
    || !($showing->datetime > \Gordesch\CineCarbon::now()->modify(config('app.online_ticketing.stop_selling_at')))
)
    </span>
@else
    </a>
@endif
