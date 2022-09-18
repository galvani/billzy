<?php

namespace App\Config;

enum UserRoleEnum: string
{
    case ROLE_USER = 'Grants login';
    case ROLE_ADMIN = 'Grants nothing but own object';
    case ROLE_SUPER_ADMIN = 'Grants everything';
}
