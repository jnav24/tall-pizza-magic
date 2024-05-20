<main
    x-data="{
        currentStatus: '',
        orders: @js($orders),
        filteredOrders: [],
        selectedOrder: {},
        selectedSidebar: '',
        sidebarItems: [],

        init() {
            this.sidebarItems = @js($statuses);
            this.selectedSidebar = this.sidebarItems?.[0]?.['value'] ?? '';
            console.log('grrr', this.selectedSidebar);
            this.updateOrders(this.selectedSidebar);

            $watch('selectedSidebar', (v) => {
                console.log('wtf');
                this.updateOrders(v);
            });
        },

        updateOrders(v) {
            console.log('selected', v);
            this.filteredOrders = this.orders.filter((order) => +order.order_status_id === +v);
            this.currentStatus = this.sidebarItems.find((s) => s.value === v)?.label;
            console.log('orders', this.orders);
            console.log('filtered', this.filteredOrders);

        },

        updateStatus(order) {
            this.selectedOrder = order;
            $dispatch('open-modal');
        },

        refreshOrders(order, status) {
            this.orders = this.orders.map((o) => {
                if (o.id === order.id) {
                    o.order_status_id = +status;
                }
                return o;
            });
            console.log('hmmm');
            this.updateOrders(this.selectedSidebar);
        },
    }"
>
    <x-shared.modal>
        <x-modals.update-status :statuses="$statuses" />
    </x-shared.modal>

    <h1 class="text-3xl text-gray-600 font-light">Orders</h1>

    <div class="grid grid-cols-4 gap-3 mt-6">
        <x-shared.sidebar title="Order Status" />

        <div class="col-span-3 ml-3 mr-4">
            <template x-if="!filteredOrders?.length">
                <x-shared.card>
                    <div class="py-8 text-gray-500 flex flex-col items-center justify-center">
                        <x-icons.warning class="size-8" />
                        <span>There are no orders with status: <span x-text="currentStatus"></span></span>
                    </div>
                </x-shared.card>
            </template>

            <template x-for="(order, i) in filteredOrders">
                <div :key="order.uuid">
                    <x-shared.card>
                        <div class="flex items-center justify-between">
                            <p x-text="order.uuid"></p>
                            <p x-text="order.created_at"></p>
                            <x-shared.button
                                color="primary"
                                @click="updateStatus(order)"
                            >
                                Update Status
                            </x-shared.button>
                        </div>
                    </x-shared.card>
                </div>
            </template>
        </div>
    </div>
</main>
