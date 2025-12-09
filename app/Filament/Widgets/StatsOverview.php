<?php

namespace App\Filament\Widgets;

use App\Models\Monitoring;
use App\Models\Suhu;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected function getStats(): array
    {
        // Picker
        $startDate = ! is_null($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        null;

        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
        Carbon::parse($this->filters['endDate']) :
        now();

        $registerMasukBulanTotal = Suhu::whereBetween('created_at', [$startDate, $endDate])->count('id');
        // $registerMasukBulanKemarin = Monitoring::whereBetween('created_at', [$startDate, $endDate])->sum('id');
        
        
        // Bulan Ini
        $registerMasukBulanIni = Suhu::whereMonth('id', Carbon::now()->month)
        ->whereYear('id', Carbon::now()->year)->count();

    // Bulan Kemarin
    $registerMasukBulanKemarin = Suhu::whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', Carbon::now()->subMonth()->year)->count();

        return [
            // Stat::make('Total Pembatalan Final Bulan Ini', Monitoring::count()),
            Stat::make('Kedisiplinan Penulisan Laporan Suhu Bulan Ini', $registerMasukBulanIni),
            Stat::make('Kedisiplinan Penulisan Laporan Suhu Bulan Kemarin', $registerMasukBulanKemarin),
            Stat::make('Selisih Kedisiplinan Penulisan Laporan Suhu Bulan Ini dengan Bulan Kemarin', $registerMasukBulanKemarin - $registerMasukBulanIni),
            Stat::make('TotalKedisiplinan Penulisan Laporan Suhu Custom', $registerMasukBulanTotal),
        ];
    }
}
