<?php
namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\VitrineResource\Pages;
use App\Models\Vitrine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VitrineResource extends Resource
{
    protected static ?string $model = Vitrine::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $modelLabel = 'Vitrine';
    protected static ?string $pluralModelLabel = 'Vitrines';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required(),
            Forms\Components\Select::make('status')->options([
                'pending'=> 'Pendente',
                'active'   => 'Ativo',
                'rejected' => 'Rejeitado',
            ])->required(),
            Forms\Components\Select::make('categoria_id')
                ->relationship('categoria', 'nome')
                ->searchable()->preload(),
            Forms\Components\TextInput::make('nome')->required(),
            Forms\Components\TextInput::make('slug')->required(),
            Forms\Components\Textarea::make('descricao'),

            Forms\Components\FileUpload::make('foto_perfil')
                ->label('Foto de Perfil')
                ->image()
                ->disk('public')
                ->directory('vitrines/perfil')
                ->imageEditor()
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('banner')
                ->label('Banner')
                ->image()
                ->disk('public')
                ->directory('vitrines/banner')
                ->imageEditor()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('whatsapp')->required(),
            Forms\Components\TextInput::make('cidade')->required(),
            Forms\Components\TextInput::make('bairro'),
            Forms\Components\TextInput::make('estado')->maxLength(2)->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nome')->searchable(),
            Tables\Columns\TextColumn::make('categoria.nome'),
            Tables\Columns\TextColumn::make('cidade'),
            Tables\Columns\TextColumn::make('status'),
        ])
->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'pending'  => 'Pendente',
                'active'   => 'Ativo',
                'rejected' => 'Rejeitado',
            ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVitrines::route('/'),
            'create' => Pages\CreateVitrine::route('/create'),
            'edit'   => Pages\EditVitrine::route('/{record}/edit'),
        ];
    }
}
