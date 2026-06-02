<?php

namespace App\Filament\Painel\Resources;

use App\Filament\Painel\Resources\VitrineResource\Pages;
use App\Filament\Painel\Resources\VitrineResource\RelationManagers;
use App\Models\Vitrine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VitrineResource extends Resource
{
    protected static ?string $model = Vitrine::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Minha Vitrine';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')->required()->maxLength(255),
                Forms\Components\Textarea::make('descricao')->required()->rows(3),
                Forms\Components\TextInput::make('whatsapp')->required()->maxLength(20),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(255)
                    ->placeholder('@seunegocio')
                    ->helperText('Seu perfil do Instagram (ex: @seunegocio)'),
                Forms\Components\TextInput::make('cidade')->required()->maxLength(100),
                Forms\Components\TextInput::make('bairro')->maxLength(100),
                Forms\Components\TextInput::make('estado')->required()->maxLength(2),
                Forms\Components\Select::make('categoria_id')
                    ->relationship('categoria', 'nome')
                    ->required(),
                Forms\Components\TagsInput::make('tags')
                    ->required()
                    ->placeholder('Ex: cabelo, barba, corte masculino')
                    ->helperText('Palavras-chave que ajudam clientes a encontrar seu negócio na busca.'),
                Forms\Components\ColorPicker::make('cor_primaria')->default('#000000'),
                Forms\Components\FileUpload::make('foto_perfil')
                    ->image()
                    ->directory('vitrines/perfil')
                    ->helperText('Dimensão recomendada: 400x400 pixels (quadrada).'),
                Forms\Components\FileUpload::make('banner')
                    ->image()
                    ->directory('vitrines/banner')
                    ->helperText('Dimensão recomendada: 1200x400 pixels (retangular). Imagens muito altas serão cortadas.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->searchable(),
                Tables\Columns\TextColumn::make('cidade'),
                Tables\Columns\TextColumn::make('categoria.nome')->label('Categoria'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
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
            'index' => Pages\ListVitrines::route('/'),
            'create' => Pages\CreateVitrine::route('/create'),
            'edit' => Pages\EditVitrine::route('/{record}/edit'),
        ];
    }
}
