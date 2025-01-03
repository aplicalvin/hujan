<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Voucher';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Voucher')
                    ->schema([
                        TextInput::make('name')->required()->columnSpanFull(),
                        TextInput::make('description')->required()->columnSpanFull(),
                        TextInput::make('point_required')->required()->numeric()->columnSpanFull(),
                        TextInput::make('discount')->currencyMask(",", ".", "2")->required()->helperText('Diskon dalam bentuk rupiah')->numeric()->columnSpanFull(),
                        DatePicker::make('expired_date')->required()->columnSpanFull(),
                        TextInput::make('voucher_code')
                            ->required()
                            ->columnSpanFull()
                            ->default(strtoupper(Str::random(4)))
                            ->disabled()
                            ->dehydrated()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('description')->searchable(),
                TextColumn::make('point_required')->searchable(),
                TextColumn::make('discount')->searchable(),
                TextColumn::make('expired_date')->searchable()->date("d M Y"),
                TextColumn::make('voucher_code')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'admin';
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        return parent::getEloquentQuery();
    }
}
