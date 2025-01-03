<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPembelian extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pembelian', Transaction::query()->where('status', 'completed')->count())
                ->description(Transaction::query()->where('status', 'completed')->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor('success')
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
