<?php

namespace App\Filament\Painel\Resources;

use App\Filament\Painel\Resources\GaleriaFotoResource\Pages;
use App\Filament\Painel\Resources\GaleriaFotoResource\RelationManagers;
use App\Models\GaleriaFoto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriaFotoResource extends Resource
{
    protected static ?string $model = GaleriaFoto::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Galeria de Fotos';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('vitrine', fn (Builder $q) => $q->where('user_id', auth()->id()));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('path')
                    ->label('Foto')
                    ->image()
                    ->directory('vitrines/galeria')
                    ->required(),
                Forms\Components\TextInput::make('legenda')->maxLength(255),
                Forms\Components\TextInput::make('ordem')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('path')
                    ->label('Foto')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('legenda')->searchable(),
                Tables\Columns\TextColumn::make('ordem')->sortable(),
            ])
            ->defaultSort('ordem')
            ->filters([])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGaleriaFotos::route('/'),
            'create' => Pages\CreateGaleriaFoto::route('/create'),
            'edit' => Pages\EditGaleriaFoto::route('/{record}/edit'),
        ];
    }
}
