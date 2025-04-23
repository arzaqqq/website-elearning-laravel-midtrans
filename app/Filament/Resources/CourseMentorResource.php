<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CourseMentor;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseMentorResource\Pages;
use App\Filament\Resources\CourseMentorResource\RelationManagers;

class CourseMentorResource extends Resource
{
    protected static ?string $model = CourseMentor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                    ->relationship('course', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                    Select::make('user_id')
                    ->label('Nama Mentor')
                    ->options(function () {
                        return User::role('mentor')->pluck('name','id');
                          })
                    ->searchable()
                    ->preload()
                    ->required(),

                    Textarea::make('about')
                          ->required(),
                    select::make('is_active')
                          ->options([
                            true => 'Active',
                            false => 'Banned',
                          ])
                          ->required()



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('mentor.photo')
                ->label('photo'),

                TextColumn::make('mentor.name')
                ->sortable()
                ->searchable(),

                TextColumn::make('course.name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListCourseMentors::route('/'),
            'create' => Pages\CreateCourseMentor::route('/create'),
            'edit' => Pages\EditCourseMentor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
