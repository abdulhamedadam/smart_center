<?php

namespace App\Filament\Resources\CoursesResource\Pages;

use App\Filament\Resources\CoursesResource;
use App\Models\Students;
use App\Services\CourseService;
use App\Services\StudentService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;

class CourseStudents extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string $resource = CoursesResource::class;
    protected static string $view = 'filament.resources.courses-resource.pages.course-students';
    protected static ?string $title = null;
    public $tap = 'students';
    public $record, $course;
    public $student_id;
    public $course_type;
    public $payment_type;
    public $total_price = 0;
    public $duration = 0;
    public $installment_amount;
    public $number_of_installments = 1;
    public $initial_payment = 0;

    protected CourseService $courseService;
    protected StudentService $studentService;

    protected $listeners = ['refreshForm' => '$refresh'];

    public function mount($record)
    {
        $this->record = $record;
        $this->courseService = app(CourseService::class);
        $this->studentService = app(StudentService::class);
        $this->course = $this->courseService->get_course($record);
        $this->total_price = $this->course->total_price ?? 0;
        $this->duration = $this->course->duration ?? 1;
        $this->number_of_installments = $this->course->duration ?? 1;
        $this->installment_amount = $this->total_price / $this->duration;

    }

    public function getTitle(): string
    {
        return __('common.CourseStudents');
    }

    public function saveStudents()
    {
        $this->validate([
            'student_id' => 'required',
            'course_type' => 'required',
            'payment_type' => 'required',
        ]);

        $data = [
            'course_id' => $this->record,
            'student_id' => $this->student_id,
            'type' => $this->course_type,

        ];

        $payment_data = [
            'payment_type' => $this->payment_type,
            'course_id' => $this->record,
            'start_date' => $this->course->start_date,
            'end_date' => $this->course->end_date,
            'student_id' => $this->student_id,
            'total_price' => $this->total_price ?? 0,
            'duration' => $this->duration ?? 0,
            'installment_amount' => $this->installment_amount ?? 0,
            'number_of_installments' => $this->number_of_installments ?? 0,
            'initial_payment' => $this->initial_payment ?? 0,
        ];

      //  dd($payment_data);
        try {
            $this->courseService = app(CourseService::class);
            $this->studentService = app(StudentService::class);
            $course_student = $this->courseService->save_students($data);
            $this->courseService->save_payment($course_student, $payment_data);

            Notification::make()
                ->title('Student saved successfully!')
                ->success()
                ->send();

            $this->reset([
                'student_id',
                'course_type',
                'payment_type',
                'total_price',
                'duration',
                'installment_amount',
                'number_of_installments',
                'initial_payment'
            ]);

            $this->dispatch('refresh');

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error saving student!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getTableQuery()
    {
        return \App\Models\CourseStudents::query()->where('course_id', $this->record);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('student.full_name')
                ->label(__('common.student')),
            TextColumn::make('type')
                ->label(__('common.type')),
            IconColumn::make('is_active')
                ->label('Status')
                ->boolean()
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->trueColor('success')
                ->falseColor('danger')
                ->tooltip(fn($state): string => $state ? 'Active' : 'Inactive')
        ];
    }

    protected function getTableActions(): array
    {
        return [
            DeleteAction::make()
                ->label(__('common.delete'))
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function (\App\Models\CourseStudents $record) {
                    $record->delete();
                    Notification::make()
                        ->title('Student removed from course')
                        ->success()
                        ->send();
                }),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('is_active')
                ->label('Status')
                ->options([
                    '1' => 'Active',
                    '0' => 'Inactive',
                ]),
            SelectFilter::make('type')
                ->label(__('common.type'))
                ->options([
                    'regular' => 'Regular',
                    'guest' => 'Guest',
                ]),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    Grid::make(3)
                        ->schema([
                            Select::make('student_id')
                                ->label(__('common.student'))
                                ->options(Students::doesntHave('courses')->pluck('full_name', 'id'))
                                ->searchable()
                                ->required(),

                            Select::make('course_type')
                                ->label(__('common.type'))
                                ->options([
                                    'online' => 'Online',
                                    'offline' => 'Offline',
                                    'hybrid' => 'Hybrid',
                                ])
                                ->required(),

                            Select::make('payment_type')
                                ->label(__('common.PaymentType'))
                                ->options([
                                    'cash' => __('common.Cash'),
                                    'installment' => __('common.Installment'),
                                    'payment_installment' => __('common.PaymentInstallment'),
                                ])
                                ->required()
                                ->live()
                                ->afterStateUpdated(fn() => $this->dispatch('refreshForm')),
                        ]),

                    TextInput::make('total_price')
                        ->label(__('common.TotalPrice'))
                        ->numeric()
                        ->default($this->course->total_price)
                        ->required()
                        ->columnSpanFull(),


                    Grid::make(3)
                        ->schema(function (Get $get) {
                            $schema = [];
                            if ($get('payment_type') === 'cash') {

                            }
                            if ($get('payment_type') === 'installment') {
                                $schema = [
                                    TextInput::make('duration')
                                        ->label(__('common.NumberInstallments'))
                                        ->numeric()
                                        ->default(12)
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state) {
                                            $this->duration = $state;
                                            $this->installment_amount = $this->total_price / $this->duration;
                                        }),

                                    TextInput::make('installment_amount')
                                        ->label(__('common.InstallmentAmount'))
                                        ->numeric()
                                        ->disabled()
                                        ->default(function (Get $get) {
                                            return $get('total_price') / $get('duration', 1);
                                        }),
                                ];
                            }

                            if ($get('payment_type') === 'payment_installment') {
                                $schema = [
                                    TextInput::make('initial_payment')
                                        ->label(__('common.InitialPayment'))
                                        ->numeric()
                                        ->default(0)
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state) {
                                            $this->initial_payment = $state;
                                            $this->installment_amount = ($this->total_price - $this->initial_payment) / $this->number_of_installments;
                                        }),

                                    TextInput::make('number_of_installments')
                                        ->label(__('common.InstallmentAmount'))
                                        ->numeric()
                                        ->default(3)
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state) {
                                            $this->number_of_installments = $state;
                                            $this->installment_amount = ($this->total_price - $this->initial_payment) / $this->number_of_installments;
                                        }),

                                    TextInput::make('installment_amount')
                                        ->label(__('common.InstallmentAmount'))
                                        ->numeric()
                                        ->disabled()
                                        ->default(function (Get $get) {
                                            $remaining = $get('total_price') - $get('initial_payment', 0);
                                            return $remaining / $get('number_of_installments', 1);
                                        }),
                                ];
                            }

                            return $schema;
                        }),

                    Actions::make([
                        Action::make('save')
                            ->label(__('common.Add'))
                            ->action('saveStudents')
                            ->color('primary')
                            ->icon('heroicon-o-plus')
                    ])
                        ->alignEnd()
                        ->extraAttributes(['class' => 'mt-6'])
                ])
        ];
    }

    protected function calculateInstallmentAmount()
    {
        if ($this->payment_type === 'payment_installment' &&
            $this->total_price &&
            $this->initial_payment &&
            $this->number_of_installments) {
            $remaining_amount = $this->total_price - $this->initial_payment;
            $this->installment_amount = $remaining_amount / $this->number_of_installments;
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['initial_payment', 'number_of_installments', 'total_price'])) {
            $this->calculateInstallmentAmount();
        }
    }
}
