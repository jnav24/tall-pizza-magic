@props(['textClass', 'iconClass' => 'text-primary size-8'])

<div class="space-x-2 flex items-center">
    <x-icons.pizza class="{{ $iconClass }}" />
    <div class="{{ $textClass }}">
        <span class="font-bold">Pizza</span><span class="font-light">Magic</span>
    </div>
</div>
