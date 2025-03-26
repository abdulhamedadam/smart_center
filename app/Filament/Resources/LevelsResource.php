<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\LevelsResource\Pages;
use App\Filament\Resources\LevelsResource\RelationManagers;
use App\Models\Levels;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LevelsResource extends Resource
{
    protected static ?string $model = Levels::class;
    protected static ?string $cluster = Settings::class;
    public static function canViewAny(): bool
    {
        return true;
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLevels::route('/'),
        ];
    }


    // LOCALIZATION =====================================================================
    // LOCALIZATION =====================================================================
    // LOCALIZATION =====================================================================


    public static function getBreadCrumb(): string
    {
        return __('common.levels');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.levels');
    }

    public static function getLabel(): string
    {
        return __('common.levels');
    }

    public static function getModelLabel(): string
    {
        return __('common.level');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.levels');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.levels');
    }
}
