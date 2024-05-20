<?php

namespace App\Livewire\Dashboard;

use App\Enums\OrderStatusEnum;
use App\Events\OrderStatusUpdate;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

#[Layout('layouts.dashboard')]
class Menu extends Component
{
    /** @var Collection<MenuItem>  */
    public Collection $items;

    public function mount(): void
    {
        $this->items = MenuItem::all();
    }

    #[On('save-order')]
    public function saveOrder(array $menuItems): RedirectResponse|Redirector
    {
        $this->authorize('create', Order::class);

        $status = OrderStatus::query()
            ->where('name', OrderStatusEnum::PENDING->value)
            ->firstOrFail();

        $order = null;

        DB::transaction(function () use ($status, $menuItems, &$order) {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'order_status_id' => $status->id,
            ]);

            $order
                ->orderDetails()
                ->createMany(
                    array_map(
                        fn ($item) => ['price' => $item['price'], 'menu_item_id' => $item['id'], 'quantity' => 1],
                        $menuItems
                    )
                );
        });

        OrderStatusUpdate::dispatch($order, OrderStatusEnum::PENDING);
        return redirect()->route('dashboard.order-confirmation', ['uuid' => $order->uuid]);
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.dashboard.menu');
    }
}
