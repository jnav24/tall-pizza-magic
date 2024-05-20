<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('orders.{orderUuid}', function (User $user, $orderUuid) {
    return $user->id === Order::where('uuid', $orderUuid)->first()?->user_id;
});
