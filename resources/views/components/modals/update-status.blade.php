@props(['statuses'])

<div
    class="p-4 w-100"
    x-data="{
        status: '',

        updateForm(e) {
            const { detail } = e;
            this.status = detail.status;
        },

        save() {
            refreshOrders(selectedOrder, this.status);
            $dispatch('update-status', { order: selectedOrder, status: this.status });
            $dispatch('close-modal');
        },
    }"
    @handle-on-change.window="updateForm($event)"
>
    <h1 class="text-2xl font-light mb-4">Update Status</h1>
    <x-shared.select label="Status" :items="$statuses" value="" />

    <div class="mt-4 space-x-2 text-right">
        <x-shared.button >Cancel</x-shared.button>

        <template x-if="!status">
            <x-shared.button
                color="primary"
                disabled
            >
                Save
            </x-shared.button>
        </template>

        <template x-if="status">
            <x-shared.button
                color="primary"
                @click="save()"
            >
                Save
            </x-shared.button>
        </template>
    </div>
</div>
