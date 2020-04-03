@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Mince !')
@else
# @lang('Bonjour,')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Salutations cinéphiles,

L'équipe du {{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si vous n'arrivez pas à cliquer sur le bouton \":actionText\", copiez-collez l'URL suivante\n".
    "dans la barre d'adresse de votre navigateur : [:displayableActionUrl](:actionURL)",
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
        'displayableActionUrl' => $displayableActionUrl,
    ]
)
@endslot
@endisset
@endcomponent
