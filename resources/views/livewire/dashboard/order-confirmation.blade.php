@php
    $total = count($order?->orderDetail ?? [])
@endphp

<div class="flex h-screen w-screen">
    <section class="w-28 shadow-2xl">
        <x-dashboard.menu-nav />
    </section>

    <section class="flex-1 pl-10 py-4 pr-4 space-y-8">
        <div class="flex justify-end">
            <livewire:dashboard.nav />
        </div>

        <div class="container">
            <div>
                <h1 class="text-2xl font-light mb-2">Order Confirmation</h1>
                <p class="text-gray-600">Order ID: {{ $order->uuid }}</p>
                <p class="text-gray-600">Order Date: {{ $order->created_at }}</p>
            </div>

            <div
                class="flex justify-center my-8"
                x-data="progressBar"
            >
                <div class="text-center space-y-6">
                    <div class="relative w-150">
                        <div class="flex items-center justify-between">
                            <div class="relative z-10 bg-success rounded-full size-6">
                            </div>
                            <div class="relative z-10 rounded-full size-6" x-bind:class="{'bg-success': progressWidth >= 50, 'bg-gray-300': progressWidth < 50}">
                            </div>
                            <div class="relative z-10 rounded-full size-6" x-bind:class="{'bg-success': progressWidth >= 100, 'bg-gray-300': progressWidth < 100}">
                            </div>
                        </div>

                        <div class="absolute bg-gray-300 rounded-lg w-full left-0 top-1/3 z-0">
                            <div class="bg-success rounded-lg h-2 transition-all duration-300 ease-in-out"
                                :style="{ width: progressWidth + '%' }"></div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl text-gray-600" x-text="statusTitle"></h2>
                        <p class="text-gray-500" x-text="statusDescription"></p>
                    </div>
                </div>
            </div>

            <x-shared.card>
                <p class="font-bold mb-6">Order Details</p>

                <div class="grid grid-cols-4 gap-3 bg-gray-200 text-gray-600 p-2">
                    <div>Item</div>
                    <div>Quantity</div>
                    <div>Price</div>
                </div>

                @foreach($order->orderDetails as $index => $detail)
                    <div class="grid grid-cols-4 gap-3 px-2 py-4 {{ $total === ($index + 1) ? 'border-b' : '' }}">
                        <div>{{ $detail->menuItem->name }}</div>
                        <div>{{ $detail->quantity }}</div>
                        <div>{{ $detail->menuItem->price }}</div>
                    </div>
                @endforeach


            </x-shared.card>
        </div>
    </section>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('progressBar', () => ({
            progressWidth: 0,

            init() {
                this.statusTitle = '';
                this.statusDescription = '';
                this.status = @js($order->status);
                this.statuses = @js($statuses);
                this.setProgress();

                Echo.private('orders.{{ $order->uuid }}')
                    .listen('OrderStatusUpdate', (e) => {
                        console.log('reverb:', e);
                        this.status = e.status;
                        this.setProgress();
                    });
            },

            setProgress() {
                if (this.status) {
                    switch (this.status.name) {
                        case 'preparing':
                            this.statusDescription = 'Prepping is done and food is being cooked.';
                            this.statusTitle = 'Placed in Oven';
                            this.progressWidth = 50;
                            break;
                        case 'ready':
                            this.statusDescription = 'Food is packed and ready to go!';
                            this.statusTitle = 'Ready for delivery or pickup';
                            this.progressWidth = 100;
                            break;
                        default:
                            this.statusDescription = 'We received your order and prepping it with our fresh ingredients.';
                            this.statusTitle = 'Working on Pizza';
                            this.progressWidth = 0;
                            break;
                    }
                }
            },
        }));
    });
</script>
