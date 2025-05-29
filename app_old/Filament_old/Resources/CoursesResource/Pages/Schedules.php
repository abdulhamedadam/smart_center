<?php

namespace App\Filament\Resources\CoursesResource\Pages;

use App\Filament\Resources\CoursesResource;
use App\Models\CourseMaterials;
use App\Models\CourseSchedule;
use App\Services\CourseService;
use App\Services\StudentService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class Schedules extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $tap = 'schedules';
    public $record, $course, $duration, $start_time, $date, $end_time, $schedules, $weeks, $startDate, $endDate, $groupedSchedules, $editingScheduleId,$status='scheduled';
    public $monthlySchedule = [];
    public $editingSchedule = null;
    public $edit_date;
    public $edit_start_time;
    public $edit_end_time;
    public $nextScheduleDate;
    public $editFormState = [];

    protected static string $resource = CoursesResource::class;
    protected static string $view = 'filament.resources.courses-resource.pages.schedules';
    protected CourseService $courseService;

    /****************************************************/
    public function mount($record)
    {
        $this->record = $record;
        $this->courseService = app(CourseService::class);
        $this->studentService = app(StudentService::class);
        $this->course = $this->courseService->get_course($record);
        $this->duration = optional($this->course)->duration;
        $this->date = optional($this->course)->start_date;

        $this->prepareScheduleData();
        $this->form->fill();
        $this->editForm->fill();
    }

    /****************************************************/
    protected function prepareScheduleData()
    {
        $schedules = CourseSchedule::where('course_id', $this->record)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        $this->nextScheduleDate = $schedules->first()?->date;
        //dd($this->nextScheduleDate);


        if ($schedules->isEmpty()) {
            return;
        }
        Carbon::setLocale('ar');

        $startDate = Carbon::parse($schedules->first()->date);
        $endDate = Carbon::parse($schedules->last()->date);
        $months = CarbonPeriod::create(
            $startDate->startOfMonth(),
            '1 month',
            $endDate->endOfMonth()
        );


        foreach ($months as $month) {
            $monthKey = $month->format('Y-m');
            $this->monthlySchedule[$monthKey] = [
                'month_name' => $month->translatedFormat('F Y'),
                'weeks' => [
                    1 => [],
                    2 => [],
                    3 => [],
                    4 => [],
                ]
            ];
        }

        foreach ($schedules as $schedule) {
            $date = Carbon::parse($schedule->date);
            $monthKey = $date->format('Y-m');
            $weekOfMonth = ceil($date->day / 7);
            $weekOfMonth = min(max($weekOfMonth, 1), 4);

            $this->monthlySchedule[$monthKey]['weeks'][$weekOfMonth][] = [
                'id' => $schedule->id,
                'status' => $schedule->status,
                'day' => $date->translatedFormat('l'),
                'date' => $date->format('Y-m-d'),
                'start_time' => Carbon::parse($schedule->start_time)->format('h:i A'),
                'end_time' => Carbon::parse($schedule->end_time)->format('h:i A'),
            ];
        }
    }

    /****************************************************/
    protected function getFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    Grid::make(3)
                        ->schema([
                            DatePicker::make('date')
                                ->label(__('Date'))
                                ->required()
                                ->native(false)
                                ->displayFormat('Y-m-d')
                                ->closeOnDateSelection(),

                            TimePicker::make('start_time')
                                ->label(__('Start Time'))
                                ->required()
                                ->seconds(false)
                                ->native(false),

                            TimePicker::make('end_time')
                                ->label(__('End Time'))
                                ->required()
                                ->seconds(false)
                                ->native(false)
                                ->afterOrEqual('start_time'),

                            TextInput::make('duration')
                                ->label(__('Duration (months)'))
                                ->default(3)
                                ->numeric()
                                ->required(),

                            Actions::make([
                                Action::make('save')
                                    ->label(__('common.Add'))
                                    ->action(function (array $data) {
                                        $validatedData = $this->form->getState();
                                        $originalDate = Carbon::parse($validatedData['date']);
                                        $startTime = $validatedData['start_time'];
                                        $endTime = $validatedData['end_time'];
                                        $durationMonths = (int)$validatedData['duration'];
                                        $weeksToCreate = $durationMonths * 4;

                                        for ($week = 0; $week < $weeksToCreate; $week++) {
                                            $schedule = new CourseSchedule();
                                            $schedule->date = $originalDate->copy()->addWeeks($week)->format('Y-m-d');
                                            $schedule->start_time = $startTime;
                                            $schedule->end_time = $endTime;
                                            $schedule->course_id = $this->record;
                                            $schedule->save();
                                        }

                                        Notification::make()
                                            ->title('Schedules added successfully')
                                            ->success()
                                            ->send();
                                        $this->dispatch('refresh');
                                    })
                                    ->color('primary')
                                    ->icon('heroicon-o-plus')
                            ])
                                ->alignStart()
                                ->extraAttributes(['class' => 'mt-6'])
                        ])
                ])
        ];
    }

    /****************************************************/
    protected function getTableQuery()
    {
        return CourseSchedule::query()->where('course_id', $this->record);
    }

    /****************************************************/
    public function editSchedule($scheduleId)
    {
        $this->editingScheduleId = $scheduleId;
        $schedule = CourseSchedule::find($scheduleId);

        if ($schedule) {
            $this->editFormState = [
                'edit_date' => $schedule->date,
                'edit_start_time' => $schedule->start_time,
                'edit_end_time' => $schedule->end_time,
                'status' => $schedule->status,
            ];
            $this->edit_date = $schedule->date;
            $this->edit_start_time = $schedule->start_time;
            $this->edit_end_time = $schedule->end_time;
            $this->status = $schedule->status;
            $this->editForm->fill($this->editFormState);
        }
    }

    /****************************************************/
    public function saveSchedule($scheduleId)
    {
        $data = $this->editForm->getState();
        $schedule = CourseSchedule::find($scheduleId);

        if ($schedule) {
            $schedule->date = $data['edit_date'];
            $schedule->start_time = $data['edit_start_time'];
            $schedule->end_time = $data['edit_end_time'];
            $schedule->status = $data['status'];

            $schedule->save();

            Notification::make()
                ->title('Schedule updated successfully')
                ->success()
                ->send();

            $this->dispatch('refresh');
        }
    }

    /****************************************************/
    public function editForm(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3),
                DatePicker::make('edit_date')
                    ->label('Date')
                    ->required()
                    ->native(false)
                    ->displayFormat('Y-m-d')
                    ->closeOnDateSelection(),

                TimePicker::make('edit_start_time')
                    ->label('Start Time')
                    ->required()
                    ->seconds(false)
                    ->native(false),

                TimePicker::make('edit_end_time')
                    ->label('End Time')
                    ->required()
                    ->seconds(false)
                    ->native(false)
                    ->afterOrEqual('edit_start_time'),

                Select::make('status')
                    ->label(__('Status'))
                    ->options([
                        'scheduled' => __('common.Scheduled'),
                        'completed' => __('common.Completed'),
                        'cancelled' => __('common.Cancelled'),
                        'postponed' => __('common.Postponed'),
                    ])
                    ->default('scheduled')
                    ->required(),
            ])
            ->statePath('editFormState');
    }

    /****************************************************/
    protected function getForms(): array
    {
        return [
            'form',
            'editForm',
        ];
    }
}
