<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Support\Facades\Log; // Importer le Log pour le debug

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        // Utilisation de Log pour déboguer
        Log::info('PostResource form called', [
            'auth_check' => auth()->check(),
            'user_id' => auth()->id(),
        ]);

        return $form
            ->schema([
                Tabs::make('Create new Post')->tabs([
                    Tab::make('Post Details')
                    ->icon('heroicon-o-adjustments-vertical')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated((function(string $operation, callable $set, $state) {
                                if ($operation === 'edit') {
                                    return;
                                }
                                $set('slug', str($state)->slug());
                            })
                        ),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        ColorPicker::make('color')
                            ->label('Color')
                            ->required()
                            ->default('#FFFFFFF'),
                    ]),
                    Tab::make('Content')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            MarkdownEditor::make('synopsis')
                                ->label('Synopsis')
                                ->required()
                                ->columnSpanFull(),
                            MarkdownEditor::make('content')
                                ->label('Content')
                                ->helperText('<img src="/chemin/vers/image.jpg" alt="Description" style="width: 300px;" />')
                                ->required()
                                ->maxLength(300)
                                ->columnSpanFull(),
                            Checkbox::make('published')
                                ->label('Published')
                    ]),
                    Tab::make('Meta')
                    ->icon('heroicon-o-archive-box-arrow-down')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            // ->multiple()
                            ->reorderable()
                            ->collection('thumbnail'),
                    TagsInput::make('tags')
                        ->label('Tags')
                        ->placeholder('Enter tags')
                        ->helperText('Add tags to the post')
                        ->required()
                        ->columnSpanFull(),
                    
                    ])
                ])->columnSpanFull()
                ->persistTabInQueryString(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(label: 'ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                ColorColumn::make('color')
                    ->label('Color')
                    ->sortable()
                    ->toggleable(),
                CheckboxColumn::make('published')
                    ->label('Published')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('comments_count')
                    ->label('Number of Comments')
                    ->sortable(),
                TextColumn::make('likes_count')
                    ->label('Number of Likes')
                    ->sortable(),
                TagsColumn::make('tags')
                    ->label('Tags')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                
            ])
            ->filters([
                TernaryFilter::make('published'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('View')
                    ->url(fn (Post $record) => route('posts.show', $record))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-eye'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount(['comments', 'likes']);
    }



}