<?php declare(strict_types=1);

namespace App\Config;

use Symfony\Component\Form\Extension\Core\Type\EnumType;

enum PaymentStatusEnum: string
{
    case Draft = 'Draft';
    case Pending = 'Pending or Scheduled';
    case Transfer = 'Transfer between Accounts';
}