@props(['innerHTML', 'href', 'type'])
<span {{ $attributes->merge(['class' => 'shadow-sm rounded-md']) }}>
  <x-admin.layout.buttons.secondary-danger :innerHTML="$innerHTML" :href="$href ?? null" :type="$type ?? null"/>
</span>
