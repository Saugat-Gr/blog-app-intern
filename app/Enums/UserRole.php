<?php

namespace App\Enums;

enum UserRole: string
{

  case ADMIN = "admin";
  case USER  = "user";
  case EDITOR = "editor";
  case SUPER_ADMIN = "super-admin";

}
