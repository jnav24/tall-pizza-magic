@props([
    'label',
    'items',
    'errors' => [],
    'name' => '',
    'itemLabel' => 'label',
    'itemValue' => 'value',
    'placeholder' => 'Select',
    'isDisabled' => false,
    'value' => ''
])

@php
    $labelId = preg_replace('/\s+/', '_', strtolower($label));
    $formLabel = empty($name) ? $labelId : $name;
    $hasError = $errors->has($labelId);
    $hasItems = count($items) > 0;

    $styles = [
        'border-solid border mt-2 rounded-md items-center justify-between outline-none transform relative',
        $isDisabled || !$hasItems ? 'bg-gray-200 border-gray-300 cursor-text text-gray-500' : '',
        !$isDisabled && !$hasError && $hasItems ? 'border-gray-300 hover:border-gray-600 bg-white cursor-pointer text-gray-600 hover:text-gray-700 focus:border-primary transition duration-300' : '',
        !$isDisabled && $hasError && $hasItems ? 'border-red-600 bg-white text-red-600' : '',
    ];

    $styles = join(' ', $styles);
@endphp

<div>
    <x-shared.label :label="$label" :label-id="$labelId" :has-error="$hasError" />

    <div class="{{ $styles }}">
        <div
            tabindex="0"
            wire:ignore
            x-data="{
                formLabel: @js($formLabel),
                isDisabled: @js($isDisabled),
                items: @js($items),
                itemLabel: @js($itemLabel),
                itemValue: @js($itemValue),
                selected: false,
                selectedValue: @js($value),

                get placeHolder() {
                    const obj = this.items.find((item) => item[this.itemValue] === this.selectedValue);

                    if (this.selectedValue && obj) {
                        return obj[this.itemLabel];
                    }

                    return @js($placeholder);
                },

                init() {
                    $refs.dropDownItems.classList.add('h-0', 'py-0');

                    $watch('selected', (value) => {
                        if (!value) {
                            setTimeout(() => {
                                $refs.dropDownItems.classList.add('h-0', 'py-0');
                            }, 300);
                        } else {
                            $refs.dropDownItems.classList.remove('h-0', 'py-0');
                        }
                    });
                },

                handleBlur() {
                    if (!this.isDisabled) {
                        this.selected = false;
                    }
                },

                handleClick() {
                    if (!this.isDisabled && this.items.length) {
                        this.selected = !this.selected;
                    }
                },

                setValue(value) {
                    $dispatch('handle-on-change', { [this.formLabel]: value });
                    this.selectedValue = value;
                    this.selected = false;
                },
            }"
            x-bind:class="{ 'z-50': selected, 'z-0': !selected }"
            @blur="handleBlur()"
        >
            <div
                class="w-full flex px-2 py-2 items-center"
                @click="handleClick()"
            >
                <span class="flex-1" x-text="placeHolder"></span>
                <span
                    class="transform transition duration-300"
                    x-bind:class="{ 'rotate-180': selected, 'rotate-0': !selected }"
                >
                <x-icons.chevron-down class="size-4" />
            </span>
            </div>

            <div
                class="bg-white border border-gray-300 shadow-sm absolute transform top-0 left-0 rounded w-full transition ease-out duration-300 max-h-48 overflow-y-auto"
                x-bind:class="{
                'translate-y-12 opacity-100': selected,
                'translate-y-0 opacity-0': !selected,
            }"
                x-ref="dropDownItems"
            >
                <template x-for="(item, index) in items" :key="index">
                    <div class="hover:bg-gray-200 p-2" @click="setValue(item[itemValue])" x-text="item[itemLabel]"></div>
                </template>
            </div>
        </div>
    </div>

    @if ($hasError)
        <span class="text-sm text-red-600">{{ $errors->first($labelId) }}</span>
    @endif
</div>
