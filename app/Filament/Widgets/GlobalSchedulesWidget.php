<?php

namespace App\Filament\Widgets;

use App\Models\CourseGroups;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class GlobalSchedulesWidget extends Widget
{
    protected static string $view = 'filament.widgets.global-schedules-widget';

    public function getSchedules(): Collection
    {
        return CourseGroups::query()
            ->with(['groupDays', 'course', 'instructor'])
            ->get()
            ->groupBy('course.name');
    }
} 