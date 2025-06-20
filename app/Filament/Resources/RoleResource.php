<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\RoleResource\Pages;
use BezhanSalleh\FilamentShield\Resources\RoleResource as ShieldRoleResource;

class RoleResource extends ShieldRoleResource
{
    protected static ?string $cluster = Settings::class;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
           // 'create' => Pages\CreateRole::route('/create'),
          //  'view' => Pages\ViewRole::route('/{record}'),
          //  'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
} 