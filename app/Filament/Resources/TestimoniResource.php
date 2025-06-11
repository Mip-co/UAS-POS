<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimoniResource\Pages;
use App\Models\Testimoni;
use App\Models\Produk;
use App\Models\KategoriTokoh;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimoniResource extends Resource
{
    protected static ?string $model = Testimoni::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TextInput::make('nama_tokoh')
                    ->required()
                    ->maxLength(45),
                Forms\Components\TextInput::make('komentar')
                    ->required()
                    ->maxLength(200),
                Forms\Components\TextInput::make('rating')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('produk_id')
                    ->label('Produk')
                    ->relationship('produk', 'nama')
                    ->required(),
                Forms\Components\Select::make('kategori_tokoh_id')
                    ->label('Kategori Tokoh')
                    ->relationship('kategoriTokoh', 'nama')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('nama_tokoh')->label('Nama Tokoh')->searchable(),
                Tables\Columns\TextColumn::make('komentar')->label('Komentar')->limit(30),
                Tables\Columns\TextColumn::make('rating')->label('Rating'),
                Tables\Columns\TextColumn::make('produk.nama')->label('Produk'),
                Tables\Columns\TextColumn::make('kategoriTokoh.nama')->label('Kategori Tokoh'),
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
            'index' => Pages\ListTestimonis::route('/'),
            'create' => Pages\CreateTestimoni::route('/create'),
            'edit' => Pages\EditTestimoni::route('/{record}/edit'),
        ];
    }
}
