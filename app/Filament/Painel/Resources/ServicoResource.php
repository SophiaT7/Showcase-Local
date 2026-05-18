<?php

namespace App\Filament\Painel\Resources;

use App\Filament\Painel\Resources\ServicoResource\Pages;
use App\Filament\Painel\Resources\ServicoResource\RelationManagers;
use App\Models\Servico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicoResource extends Resource
{
    protected static ?string $model = Servico::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Servicos';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('vitrine', fn (Builder $q) => $q->where('user_id', auth()->id()));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')->required()->maxLength(255),
                Forms\Components\Textarea::make('descricao')->rows(2),
                Forms\Components\TextInput::make('preco')
                    ->numeric()
                    ->prefix('R$')
                    ->nullable()
                    ->helperText('Deixe em branco para não exibir o preço (ex: preço sob consulta)'),
                Forms\Components\TextInput::make('preco_label')
                    ->label('Label do preço')
                    ->placeholder('Ex: a partir de, sob consulta')
                    ->maxLength(50)
                    ->helperText('Texto exibido junto ou no lugar do preço'),
                Forms\Components\Toggle::make('ativo')->default(true),
                Forms\Components\TextInput::make('ordem')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->searchable(),
                Tables\Columns\TextColumn::make('preco')
                    ->money('BRL')
                    ->placeholder('Sob consulta'),
                Tables\Columns\IconColumn::make('ativo')->boolean(),
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
            'index' => Pages\ListServicos::route('/'),
            'create' => Pages\CreateServico::route('/create'),
            'edit' => Pages\EditServico::route('/{record}/edit'),
        ];
    }
}
