@props(['block' => false, 'class' => '', 'color' => 'default', 'disabled' => false, 'fab' => false])

@php
    $colors = [
        'danger' => 'bg-danger hover:bg-danger-hover active:bg-danger-focus text-white',
        'default' => 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 active:bg-gray-200',
        'outline-inverse' => 'border border-gray-300 text-white hover:text-gray-100 hover:border-gray-100 active:border-gray-200',
        'primary' => 'bg-primary text-white hover:bg-primary-hover active:bg-primary-focus',
        'primary-outline' => 'border border-primary text-primary hover:border-primary-hover active:border-primary-focus',
    ];

    $styles = [
        $disabled ? 'bg-gray-300 cursor-text text-gray-500' : $colors[$color] ?? $colors['default'],
        $block ? 'w-full' : '',
        $fab ? 'rounded-full p-2' : 'rounded-md px-6 py-3 text-sm',
        'focus:shadow-outline rounded transition duration-150 focus:outline-none',
        $class
    ];

    $styles = implode(" ", $styles);
@endphp

<button class="{{ $styles }}" {{ $attributes }}>
    <span class="flex flex-row items-center justify-center space-x-2">
        {{ $slot }}
    </span>
</button>
