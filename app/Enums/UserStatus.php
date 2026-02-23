<?php

namespace App\Enums;

enum UserStatus : string
{
     case ACTIVE = 'active';
    case INACTIVE = 'in-active';
    case SUSPENDED = 'suspended';
}
