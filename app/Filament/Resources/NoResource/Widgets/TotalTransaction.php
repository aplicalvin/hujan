<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalTransaction extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Transaksi', Transaction::count())
                ->description(Transaction::count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor('success')
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
