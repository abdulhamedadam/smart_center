<?php

namespace App\Filament\Resources\CoursesResource\Pages;

use App\Filament\Resources\CoursesResource;
use App\Models\CourseAttendance;
use App\Models\CourseAttendanceDetail;
use App\Models\CourseAttendanceDetails;
use App\Models\CourseSchedule;
use App\Models\Students;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class Attendance extends Page implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    protected static string $resource = CoursesResource::class;
    protected static string $view = 'filament.resources.courses-resource.pages.attendance';

    public ?array $data = [];
    public $record;
    public $course;
    public $tap = 'attendance';
    public $attendance_dates;
    public $stats = [
        'present' => 0,
        'absent' => 0,
        'total' => 0
    ];

    public function mount($record)
    {
        $this->record = $record;
        $this->course = $this->getCourse();
        $this->form->fill();
        $this->attendance_dates = $this->getAttendanceDates();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CourseAttendance::query()
                    ->where('course_id', $this->record)
                    ->withCount([
                        'details as present_count' => function($query) {
                            $query->where('status', 1);
                        },
                        'details as absent_count' => function($query) {
                            $query->where('status', 2);
                        }
                    ])
            )
            ->columns([
                TextColumn::make('date')
                    ->label(__('common.Date'))
                    ->date()
                    ->sortable(),

                TextColumn::make('present_count')
                    ->label(__('common.Present'))
                    ->color('success'),

                TextColumn::make('absent_count')
                    ->label(__('common.Absent'))
                    ->numeric()
                    ->color('danger'),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->defaultSort('date', 'desc');
    }


    protected function getAttendanceDates()
    {
        return CourseAttendance::where('course_id', $this->record)
            ->pluck('date')
            ->unique()
            ->toArray();
    }

    protected function getCourse()
    {
        return \App\Models\Courses::find($this->record);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Select::make('selectedDate')
                            ->label('Class Date')
                            ->required()
                            ->options(function () {
                                return CourseSchedule::where('course_id', $this->record)
                                    ->orderBy('date', 'asc')
                                    ->get()
                                    ->mapWithKeys(function ($schedule) {
                                        $date = $schedule->date;
                                        $dateObj = \Carbon\Carbon::parse($date);

                                        $hasAttendance = in_array($date, $this->attendance_dates);

                                        return [
                                            $date => $dateObj->format('Y-m-d') .
                                                ($hasAttendance ? __('common.attendance_exists') : '')
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->live()
                            ->columnSpan(1)
                            ->searchable()
                            ->columns(3)
                            ->afterStateUpdated(function () {
                                $this->loadStudentsForDate();
                            }),
                    ])->columnSpan('full'),

                Repeater::make('attendance')
                    ->schema([
                        Hidden::make('student_id'),

                        Radio::make('status')
                            ->label(function ($get, $set) {
                                $index = $get('..');
                                $studentId = $index['student_id'] ?? null;

                                return $this->getStudentName($studentId);
                            })
                            ->options([
                                CourseAttendanceDetails::STATUS_PRESENT => __('common.Present'),
                                CourseAttendanceDetails::STATUS_ABSENT => __('common.Absent'),
                            ])
                            ->default('present')
                            ->inline()
                    ])->disableItemDeletion()
                    ->disableItemMovement()
                    ->disableItemCreation()
                    ->columns(1)
                    ->grid(1)
                    ->columnSpan('full')
                    ->visible(fn(): bool => !empty($this->data['selectedDate']))
                    ->columns(1)
            ])
            ->statePath('data');
    }

    protected function loadStudentsForDate()
    {
        if (empty($this->data['selectedDate'])) {
            return;
        }

        $selectedDate = $this->data['selectedDate'];

        // Check if attendance exists for this date
        if (in_array($selectedDate, $this->attendance_dates)) {
            // Load existing attendance records
            $mainAttendance = CourseAttendance::where('course_id', $this->course->id)
                ->where('date', $selectedDate)
                ->first();

            $existingDetails = CourseAttendanceDetails::where('attendance_id', $mainAttendance->id)
                ->get()
                ->keyBy('student_id');

            $this->data['attendance'] = $this->course->CourseStudents->map(function ($student) use ($existingDetails) {
                $existing = $existingDetails->get($student->student_id);

                return [
                    'student_id' => $student->student_id,
                    'status' => $existing ? $existing->status : CourseAttendanceDetails::STATUS_PRESENT
                ];
            })->toArray();
        } else {
            // Default behavior for new dates
            $this->data['attendance'] = $this->course->CourseStudents->map(function ($student) {
                return [
                    'student_id' => $student->student_id,
                    'status' => CourseAttendanceDetails::STATUS_PRESENT
                ];
            })->toArray();
        }
    }

    protected function getStudentName($studentId): string
    {
        if (!$studentId) {
            return 'Unknown Student';
        }

        $student = Students::find($studentId);
        return $student ? $student->full_name : 'Unknown Student';
    }

    public function submitAttendance()
    {
        $data = $this->form->getState();

        $mainAttendance = CourseAttendance::updateOrCreate([
            'course_id' => $this->course->id,
            'date' => $data['selectedDate'],
        ], [
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        // Save attendance details
        foreach ($data['attendance'] as $attendance) {
            CourseAttendanceDetails::updateOrCreate([
                'attendance_id' => $mainAttendance->id,
                'student_id' => $attendance['student_id'],
            ],[
                'status' => $attendance['status'],
            ]);
        }

        Notification::make()
            ->title('Attendance saved successfully')
            ->success()
            ->send();

        $this->dispatch('refresh');
    }
}
