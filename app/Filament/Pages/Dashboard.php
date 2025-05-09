<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TodaysFollowUps;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            TodaysFollowUps::class,

        ];
    }

    public function getColumns(): int|string|array
    {
        return 2;
    }
}
