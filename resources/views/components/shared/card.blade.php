@props(['class' => ''])

<div
    class="bg-white rounded-md shadow-sm transition duration-150 my-2 sm:my-4 py-4 {{ $class }}"
>
    <div class="px-4">
        {{ $slot }}
    </div>
</div>
