<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class DetailMenu extends ViewRecord
{
    protected static string $resource = MenuResource::class;
    protected static ?string $navigationLabel = "Detail Menu";

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Detail Menu')->schema([
                TextEntry::make('category.name'),
                TextEntry::make('name'),
                TextEntry::make('description'),
                TextEntry::make('price')->money("IDR", 1, "id"),
                ImageEntry::make('image'),
                TextEntry::make('point')
            ])
        ]);
    }
}
