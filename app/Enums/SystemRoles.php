<?php

namespace App\Enums;

enum SystemRoles : string
{
    case SUPERADMIN = 'Super-admin';
    case ADMIN = 'Admin';
    case SUB_ADMIN = 'Sub-admin';
    case REAL_STATE_AGENCY = 'Real-estate-agency';
    case REAL_STATE_AGENT = 'Real-estate-agent';
    case USER = 'User';
}
