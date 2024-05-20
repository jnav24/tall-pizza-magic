<div
    class="flex h-screen w-screen"
    x-data="{
        orderDetails: [],
        total: 0,

        addToOrder(order) {
            this.orderDetails.push(order);
            this.total = +this.total + +order.price;
        },

        removeFromOrder(order) {
            this.orderDetails = this.orderDetails.filter((od) => order.id !== od.id);
            this.total = +this.total - +order.price;
        },

        saveOrder() {
            $dispatch('save-order', { menuItems: this.orderDetails });
            this.orderDetails = [];
            this.total = 0;
        },
    }"
>
    <section class="w-28 shadow-2xl">
        <x-dashboard.menu-nav />
    </section>

    <section class="flex-1 pl-10 py-4 pr-4 space-y-8 container">
        <div class="flex justify-end">
            <livewire:dashboard.nav />
        </div>

        <div class="space-x-2">
            <x-shared.button color="primary-outline">All</x-shared.button>
            <x-shared.button color="primary">Pizzas</x-shared.button>
            <x-shared.button color="primary-outline">Salads</x-shared.button>
            <x-shared.button color="primary-outline">Beverages</x-shared.button>
        </div>

        <div>
            <h1 class="text-2xl text-gray-800 font-light">Select Your Pizza</h1>

            <div class="grid grid-cols-4 gap-6">
                @foreach($items as $item)
                    <x-shared.card class="w-full">
                        <div class="w-full h-32 overflow-hidden rounded-lg">
                            <img src="{{ $item->img_url }}" alt="{{ $item->name }}" class="object-cover w-full">
                        </div>
                        <p class="text-gray-800 my-4">{{ $item->name }}</p>

                        <div class="flex justify-between items-center">
                            <x-shared.button color="primary" fab @click="addToOrder({{ $item }})">
                                <x-icons.shopping-cart class="size-6" />
                            </x-shared.button>
                            <p class="text-gray-800 text-xl">
                                <span class="text-primary">$</span>
                                <span>{{ $item->price }}</span>
                            </p>
                        </div>
                    </x-shared.card>
                @endforeach
            </div>
        </div>
    </section>

    <section class="w-100 bg-slate-800">
        <div class="flex flex-col justify-between h-full">
            <div class="border-b border-gray-700 text-center py-4">
                <h2 class="text-white text-2xl font-light">Order Details</h2>
            </div>

            <div class="flex-1">
                <template x-if="!orderDetails.length">
                    <div class="flex justify-center align-middle items-center h-full">
                        <p class="text-gray-400">Cart is empty</p>
                    </div>
                </template>

                <template x-for="(order, idx) in orderDetails">
                    <div class="border-b border-gray-700 flex items-center justify-evenly py-4" :key="idx">
                        <div class="w-24 h-12 rounded overflow-hidden">
                            <img x-bind:src="order.img_url" class="object-cover w-full" />
                        </div>
                        <p class="text-gray-400" x-text="order.name"></p>
                        <p class="text-gray-400">
                            $<span x-text="order.price"></span>
                        </p>
                        <x-shared.button color="danger" fab @click="removeFromOrder(order)">
                            <x-icons.closed class="size-3" />
                        </x-shared.button>
                    </div>
                </template>

                <template x-if="orderDetails.length">
                    <div class="bg-primary flex text-white text-sm justify-between items-center px-4 py-2">
                        <p>Total</p>
                        <p>$<span x-text="total"></span></p>
                    </div>
                </template>
            </div>

            <div class="py-6 flex items-center justify-center space-x-4">
                <x-shared.button color="outline-inverse">Reset</x-shared.button>

                <template x-if="!orderDetails.length">
                    <x-shared.button color="primary" disabled>
                        <x-icons.shopping-cart class="size-6" />
                        <span class="px-4 inline-block">Place Order</span>
                    </x-shared.button>
                </template>

                <template x-if="orderDetails.length">
                    <x-shared.button color="primary" @click="saveOrder()">
                        <x-icons.shopping-cart class="size-6" />
                        <span class="px-4 inline-block">Place Order</span>
                    </x-shared.button>
                </template>
            </div>
        </div>
    </section>
</div>
