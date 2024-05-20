@props(['isOpen' => false, 'name' => Str::random()])

<section
    x-data="{
        isOpen: @js($isOpen),
        name: @js($name),
        showContent: false,
    }"
    x-on:open-modal.window="isOpen = (($event.detail.name || name) === name)"
    x-on:close-modal.window="isOpen = false"
>
    <article
        class="relative z-100"
        x-cloak
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-225"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-225"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="fixed z-100 overflow-hidden inset-0 overflow-y-auto">
            <div
                class="flex flex-row items-center justify-center min-h-screen text-center"
            >
                <div class="fixed inset-0">
                    <div
                        class="absolute inset-0 bg-black opacity-75"
                        @click="$dispatch('close-modal')"
                    ></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                    class="hidden sm:inline-block sm:align-middle sm:h-screen"
                ></span>
                &#8203;

                <article
                    x-show="isOpen"
                    x-transition:enter="transition ease-out duration-225"
                    x-transition:enter-start="translate-y-full"
                    x-transition:enter-end="translate-y-0"
                    x-transition:leave="transition ease-in duration-225"
                    x-transition:leave-start="translate-y-0"
                    x-transition:leave-end="translate-y-full"
                >
                    <div
                        aria-labelledby="modal-content"
                        aria-modal="true"
                        class="inline-block align-bottom bg-white rounded-lg text-left shadow-xl transform transition-all sm:align-middle"
                        role="dialog"
                    >
                        {{ $slot }}
                    </div>
                </article>
            </div>
        </div>
    </article>
</section>
