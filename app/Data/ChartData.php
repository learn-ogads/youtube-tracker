<?php

namespace App\Data;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ChartData extends Data
{
    public function __construct(
        public Collection $labels,
        public Collection $totals,
        public int $count
    ) {}
}
