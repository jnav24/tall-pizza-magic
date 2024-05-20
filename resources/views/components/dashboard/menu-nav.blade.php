@php
$menu = [
    ['to' => 'dashboard.menu', 'icon' => 'icons.food', 'label' => 'Menu'],
    ['to' => 'dashboard.order-history', 'icon' => 'icons.history', 'label' => 'Orders'],
];
@endphp

@foreach($menu as $item)
    @php
        $isActive = url()->current() === route($item['to']);
    @endphp

    <a
        class="{{ $isActive ? 'bg-primary bg-opacity-25' : 'hover:bg-primary-hover transition-all duration-150' }} w-full flex justify-center py-8"
        href="{{ route($item['to']) }}"
        wire:navigate
    >
        <span class="{{ $isActive ? 'text-primary' : 'text-gray-800' }}">
            <span class="flex justify-center">
                <x-dynamic-component :component="$item['icon']" class="size-8" />
            </span>
            <span class="text-sm ">{{ $item['label'] }}</span>
        </span>
    </a>
@endforeach
