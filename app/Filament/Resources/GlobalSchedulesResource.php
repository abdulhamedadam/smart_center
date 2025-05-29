<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GlobalSchedulesResource\Pages;
use App\Filament\Widgets\GlobalSchedulesWidget;
use App\Models\CourseSchedule;
use App\Models\CourseGroups;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\DB;

class GlobalSchedulesResource extends Resource
{
    protected static ?string $model = CourseSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'All Schedules';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): string
    {
        return __('common.courses_management');
    }

    public static function getModelLabel(): string
    {
        return __('common.schedules');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.schedules');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                CourseGroups::query()
                    ->with(['groupDays', 'course', 'instructor'])
                    ->select('tbl_course_groups.*')
                    ->join('tbl_courses', 'tbl_course_groups.course_id', '=', 'tbl_courses.id')
                    ->orderBy('tbl_courses.name')
            )
            ->columns([
                TextColumn::make('course.name')
                    ->label(__('common.course')),
                ...self::getDayColumns(),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                //
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

    protected static function getDayColumns(): array
    {
        $days = [
            'saturday' => 'Sat',
            'sunday' => 'Sun',
            'monday' => 'Mon',
            'tuesday' => 'Tue',
            'wednesday' => 'Wed',
            'thursday' => 'Thu',
            'friday' => 'Fri',
        ];

        $columns = [];

        foreach ($days as $dayKey => $dayLabel) {
            $columns[] = TextColumn::make($dayKey)
                ->label($dayLabel)
                ->getStateUsing(function ($record) use ($dayKey) {
                    $groupDay = $record->groupDays->firstWhere('day', $dayKey);
                    if ($groupDay) {
                        $start = $groupDay->start_time ? date('H:i', strtotime($groupDay->start_time)) : '';
                        $end = $groupDay->end_time ? date('H:i', strtotime($groupDay->end_time)) : '';
                        $instructor = $record->instructor->name ?? '';
                        $groupName = $record->name ?? '';

                        return "<div style='line-height: 1.5;'>
                            <div style='color: #00bb00'>✓</div>
                            <div>{$start} - {$end}</div>
                            <div>{$groupName}</div>
                            <div>{$instructor}</div>
                        </div>";
                    }
                    return '';
                })
                ->html()
                ->wrap()
                ->alignCenter();
        }

        return $columns;
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
            'index' => Pages\ListGlobalSchedules::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            GlobalSchedulesWidget::class,
        ];
    }
} 