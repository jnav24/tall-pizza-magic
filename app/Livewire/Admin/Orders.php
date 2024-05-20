<?php

namespace App\Livewire\Admin;

use App\Enums\OrderStatusEnum;
use App\Events\OrderStatusUpdate;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin')]
class Orders extends Component
{
    use AuthorizesRequests;

    /** @var Collection<Order>  */
    public Collection $orders;

    /** @var Collection<OrderStatus>  */
    public Collection $statuses;

//    public int $selectedStatus = 1;

    public function mount(): void
    {
        $this->authorize('viewAny', Order::class);

        $this->orders = Order::query()
            ->with(['orderDetails', 'status'])
            ->get();

        $this->statuses = OrderStatus::all()
            ->map(fn (OrderStatus $status) => ['label' => Str::ucfirst($status->name), 'value' => $status->id]);
    }

    #[On('update-status')]
    public function updateOrderStatus(Order $order, string $status)
    {
         $this->authorize('update', $order);

        $order->order_status_id = (int) $status;
        $order->save();

        $this->orders = Order::query()
            ->with(['orderDetails', 'status'])
            ->get();

        OrderStatusUpdate::dispatch($order, OrderStatusEnum::PREPARING);

//        $this->refresh();
//        $this->selectedStatus = (int) $status;
//        $this->dispatch('created');
//        return redirect()->route('admin.orders');
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.admin.orders');
    }
}
