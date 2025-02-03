<?php

namespace App\Enums;

enum QueueStatusEnum: string{
    case ACTIVE = 'ACTIVE';
    case ATTENDED = 'ATTENDED';
    case CANCELED = 'CANCELED';
}