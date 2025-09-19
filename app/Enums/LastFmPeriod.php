<?php

declare(strict_types=1);

namespace App\Enums;

enum LastFmPeriod: string
{
    case DAYS_7 = '7day';
    case MONTH_1 = '1month';
    case MONTH_3 = '3month';
    case MONTH_6 = '6month';
    case OVERALL = 'overall';
    case YEAR_1 = '12month';
}
