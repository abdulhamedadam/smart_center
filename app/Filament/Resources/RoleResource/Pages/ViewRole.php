<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use BezhanSalleh\FilamentShield\Resources\RoleResource\Pages\ViewRole as ShieldViewRole;
use Filament\Actions;

class ViewRole extends ShieldViewRole
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
} 