<?php

namespace App\Livewire\Dashboard;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.dashboard')]
class OrderHistory extends Component
{
    public function render(): View|Application|Factory
    {
        return view('livewire.dashboard.order-history');
    }
}
