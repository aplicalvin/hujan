<?php

namespace App\Filament\Resources\NoResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalMember extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Member', User::query()->where('role', 'member')->count())
                ->description(User::query()->where('role', 'member')->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->descriptionColor('success')
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }

}

