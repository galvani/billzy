<?php declare(strict_types=1);

namespace App\Config;

use Symfony\Component\Form\Extension\Core\Type\EnumType;

enum PaymentTypeEnum: string
{
    case Incoming = 'Left/Start aligned';
    case Outgoing = 'Center/Middle aligned';
    case Transfer = 'Right/End aligned';
}