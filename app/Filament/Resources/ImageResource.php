<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Media';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Image')
                    ->collection('images')
                    ->image()
                    ->preserveFilenames(true)
                    ->reorderable()
                    ->enableOpen()
                    ->enableDownload()
                    ->required(),
                TextInput::make('alt_text')
                    ->label('Alt Text')
                    ->maxLength(255)
                    ->helperText('Utilisé pour l’accessibilité et le SEO')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('media') // Utilise la relation media pour affichage
                    ->label('Image')
                    ->getStateUsing(fn(Image $record) => $record->getImageUrl())
                    ->size(100),
                TextColumn::make('alt_text')
                    ->label('Alt Text')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('image_url')
                    ->label('URL de l’image')
                    ->getStateUsing(fn(Image $record) => $record->getImageUrl())
                    ->copyable()
                    ->copyMessage('Copié !')
                    ->copyMessageDuration(1500)
                    ->toggleable()
                    ->wrap(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}