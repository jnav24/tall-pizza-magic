<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.dashboard')]
class OrderConfirmation extends Component
{
    public Order $order;

    /** @var Collection<OrderStatus>  */
    public Collection $statuses;

    public function mount(): void
    {
        $this->order = Order::query()
            ->with(["orderDetails", "orderDetails.menuItem", "status"])
            ->where("uuid", request()->route('uuid'))
            ->where('user_id', auth()->user()->id)
            ->first();

        $this->statuses = OrderStatus::all();

        if (empty($this->order)) {
            abort(404);
        }

        $this->authorize('view', $this->order);
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.dashboard.order-confirmation');
    }
}
