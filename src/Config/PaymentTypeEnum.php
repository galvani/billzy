<?php declare(strict_types=1);

namespace App\Config;

enum PaymentTypeEnum: string
{
    case Incoming = 'Incoming Payment will be paid to user';
    case Outgoing = 'Outgoing Payment will sent to client';
    case Transfer = 'Transfer of means between accounts. Not Implemented';
}