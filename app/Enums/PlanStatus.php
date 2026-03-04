<?php

namespace App\Enums;

enum PlanStatus: string
{
    case ALL = "all";
     case ACTIVE = 'active';
    case INACTIVE = 'in-active';
}
