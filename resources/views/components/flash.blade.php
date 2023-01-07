@props(['color' => 'is-success', 'flash_name'])

<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
    class="notification {{ $color }} has-text-centered flash-message">
    {{ session()->get($flash_name) }}
</div>
