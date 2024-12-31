<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class DetailCategory extends ViewRecord
{
    protected static string $resource = CategoryResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->
            schema([
                Section::make('Detail Kategori')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('description'),
                        TextEntry::make('is_active')->label("Status")
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                '1' => 'success',
                                '0' => 'danger',
                            })->formatStateUsing(fn($state) => $state == "1" ? "Active" : "Inactive")
                    ])
        ]);
    }
}
