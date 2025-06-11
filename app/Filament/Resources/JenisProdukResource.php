<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisProdukResource\Pages;
use App\Filament\Resources\JenisProdukResource\RelationManagers;
use App\Models\JenisProduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JenisProdukResource extends Resource
{
    protected static ?string $model = JenisProduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(45),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                \Filament\Tables\Columns\TextColumn::make('nama')->label('Nama')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListJenisProduks::route('/'),
            'create' => Pages\CreateJenisProduk::route('/create'),
            'edit' => Pages\EditJenisProduk::route('/{record}/edit'),
        ];
    }
}
