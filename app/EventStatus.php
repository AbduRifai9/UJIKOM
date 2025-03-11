<?php

namespace App\Enums;

enum EventStatus: string
{
    case Segera = 'Segera';
    case Selesai = 'Selesai';
    case Dibatalkan = 'Dibatalkan';
}
