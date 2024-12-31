<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class DetailProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $navigationLabel = "Detail Produk";

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Detail Produk')->schema([
                TextEntry::make('name')->columnSpanFull(),
                TextEntry::make('description')->columnSpanFull(),
                TextEntry::make('price')->money("IDR", 1, "id")->columnSpanFull(),
                ImageEntry::make('image')->columnSpanFull(),
                TextEntry::make('point')->columnSpanFull()
            ])
        ]);
    }
}
