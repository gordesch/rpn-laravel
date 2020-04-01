@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ config('app.url') }}/css/logo-texte@2x.png" width="83" height="75" class="logo" alt="Cinéma Royal Palace">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
{{ config('app.name') }}<br>
165, grande-rue Charles-de-Gaulle<br>
94130 Nogent-sur-Marne<br>
France<br>
<a href="https://royalpalacenogent.fr">https://royalpalacenogent.fr</a>
@endcomponent
@endslot
@endcomponent
