<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case PENDING = 'pending';
    case PREPARING = 'preparing';
    case READY = 'ready';
}
