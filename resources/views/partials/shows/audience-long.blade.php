@if ($show->audience === '18')
    <p class="text-danger">Interdit aux moins de dix-huit ans</p>
@elseif ($show->audience === '16')
    <p class="text-danger">Interdit aux moins de seize ans</p>
@elseif ($show->audience === '12')
    <p class="text-danger">Interdit aux moins de douze ans</p>
@elseif ($show->audience === 'av')
    <p class="text-danger">Avertissement : des scènes peuvent choquer la sensibilité des plus jeunes</p>
@elseif ($show->audience && ($show->audience < 12))
    <p class="text-info">Conseillé à partir de {{ $show->audience }} ans</p>
@endif
