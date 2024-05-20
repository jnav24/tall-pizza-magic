<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->getRoleNames()->contains(RoleEnum::ADMIN->value);
    }

    public function view(User $user, Order $order): bool
    {
        return $user->getRoleNames()->contains(RoleEnum::USER->value) && $user->id === $order->user_id;
    }

    public function create(User $user): bool
    {
        return $user->getRoleNames()->contains(RoleEnum::USER->value);
    }

    public function update(User $user, Order $order): bool
    {
        return $user->getRoleNames()->contains(RoleEnum::ADMIN->value);
    }

    public function delete(User $user, Order $order): bool
    {
        return false;
    }

    public function restore(User $user, Order $order): bool
    {
        return false;
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return false;
    }
}
