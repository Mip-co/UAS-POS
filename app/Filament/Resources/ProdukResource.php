<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use App\Models\JenisProduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(45),
                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('rating')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('min_stok')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('jenis_produk_id')
                    ->label('Jenis Produk')
                    ->relationship('jenisProduk', 'nama')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->nullable(),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('produk-foto')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('kode')->label('Kode')->searchable(),
                Tables\Columns\TextColumn::make('nama')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('harga')->label('Harga'),
                Tables\Columns\TextColumn::make('stok')->label('Stok'),
                Tables\Columns\TextColumn::make('rating')->label('Rating'),
                Tables\Columns\TextColumn::make('min_stok')->label('Min Stok'),
                Tables\Columns\TextColumn::make('jenisProduk.nama')->label('Jenis Produk'),
                Tables\Columns\TextColumn::make('deskripsi')->label('Deskripsi')->limit(30),
                Tables\Columns\ImageColumn::make('foto')->label('Foto'), // tambahkan ini
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
