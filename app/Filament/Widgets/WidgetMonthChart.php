<?php

namespace App\Filament\Widgets;

use App\Models\Monitoring;
use App\Models\Suhu;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class WidgetMonthChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Grafik Kedisiplinan Penulisan Suhu Bulanan';
    protected static string $color = 'info';

    protected function getData(): array
    {
        // Picker
        $startDate = ! is_null($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        now();

        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
        Carbon::parse($this->filters['endDate']) :
        now();

        $data = Trend::model(Suhu::class)
        ->between(
            start: $startDate,
            end: $endDate,
        )
        ->perMonth()
        ->count('id');
 
    return [
        'datasets' => [
            [
                'label' => 'Grafik Kedisiplinan Penulisan Suhu Bulanan',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
