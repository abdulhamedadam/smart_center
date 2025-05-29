<?php

namespace App\Filament\Resources\GlobalSchedulesResource\Pages;

use App\Filament\Resources\GlobalSchedulesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGlobalSchedules extends ListRecords
{
    protected static string $resource = GlobalSchedulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('common.create')),
        ];
    }

    public function getTitle(): string
    {
        return __('common.schedules');
    }
} 