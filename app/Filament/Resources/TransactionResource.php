<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Transaksi';
    public static function getModelLabel(): string
    {
        return "Transaksi";
    }

    public static function getPluralModelLabel(): string
    {
        return "Transaksi";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->label('Nomor Invoice')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Nama Pelanggan')->default('Anonim')->searchable(),
                Tables\Columns\TextColumn::make('table_number')->label('Nomor Meja')->badge()->searchable(),
                Tables\Columns\TextColumn::make('total_amount')->label('Total Harga')->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                Tables\Columns\TextColumn::make('total_point')->label('Total Point')->badge()->color('success'),
                Tables\Columns\SelectColumn::make('status')->label('Status')->options([
                    'pending' => 'Pending',
                    'cooking' => 'Cooking',
                    'completed' => 'Completed',
                    'canceled' => 'Canceled',
                ]),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Transaksi')->dateTime('d-m-Y H:i:s'),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('5s')
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
        ];
    }
}
