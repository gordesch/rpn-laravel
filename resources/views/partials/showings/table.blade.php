<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            @foreach($week->days as $day)
                <th>
                    <abbr
                        title="{{ $day->formatLocalized('%A %d %B %G') }}"
                    >
                        {{ $day->formatLocalized('%a %d') }}
                    </abbr>
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($week->days as $day)
                @php
                    $showings = $programming->showings->filter(function ($showing) use ($day) {
                        return $showing->datetime->isSameDay($day);
                    });
                @endphp
                <td>
                    @foreach($showings as $showing)
                        @include('partials.showings.button')
                        <br>
                    @endforeach
                </td>
            @endforeach
        </tr>
        </tbody>
    </table>
</div>
