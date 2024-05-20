<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case CREATE_ORDER = 'create_order';
    case UPDATE_ORDER = 'update_order';
    case VIEW_ORDER = 'view_order';
}
