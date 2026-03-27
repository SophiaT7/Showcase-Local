<?php

namespace App\Filament\Painel\Resources;

use App\Filament\Painel\Resources\HorarioResource\Pages;
use App\Filament\Painel\Resources\HorarioResource\RelationManagers;
use App\Models\Horario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HorarioResource extends Resource
{
    protected static ?string $model = Horario::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Horarios';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('vitrine', fn (Builder $q) => $q->where('user_id', auth()->id()));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('dia_semana')
                    ->options([
                        0 => 'Domingo',
                        1 => 'Segunda-feira',
                        2 => 'Terca-feira',
                        3 => 'Quarta-feira',
                        4 => 'Quinta-feira',
                        5 => 'Sexta-feira',
                        6 => 'Sabado',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('abertura'),
                Forms\Components\TimePicker::make('fechamento'),
                Forms\Components\Toggle::make('fechado')->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dia_semana')
                    ->formatStateUsing(fn ($state) => ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'][$state] ?? $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('abertura'),
                Tables\Columns\TextColumn::make('fechamento'),
                Tables\Columns\IconColumn::make('fechado')->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),
            ])
            ->defaultSort('dia_semana')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHorarios::route('/'),
            'create' => Pages\CreateHorario::route('/create'),
            'edit' => Pages\EditHorario::route('/{record}/edit'),
        ];
    }
}
