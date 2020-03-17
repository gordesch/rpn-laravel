@props(['href', 'type'])
<span {{ $attributes->merge(['class' => 'shadow-sm rounded-md']) }}>
  <x-admin.layout.buttons.primary :href="$href ?? null" :type="$type ?? null">
    {{ $slot }}
  </x-admin.layout.buttons.primary>
</span>
