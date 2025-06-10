<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionPaymentResource\Pages;
use App\Models\CoursePayments;
use App\Models\Courses;
use App\Models\Students;
use App\Services\CourseService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class SubscriptionPaymentResource extends Resource
{
    protected static ?string $model = CoursePayments::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;
//    protected static ?int $sort = 3;
    public static function getNavigationGroup(): string
    {
        return __('common.courses_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('common.PaymentDetails'))
                    ->schema([
                        // Student selection
                        Forms\Components\Select::make('student_id')
                            ->label(__('common.Student'))
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('course_id', null);
                                $set('total_amount', null);
                                $set('amount', null);
                            })
                            ->options(Students::query()->pluck('full_name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Course selection
                        Forms\Components\Select::make('course_id')
                            ->label(__('common.Course'))
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $set('total_amount', null);
                                $set('amount', null);

                                if ($state) {
                                    $course = Courses::find($state);
                                    if ($course) {
                                        $set('total_amount', $course->price);
                                        if ($get('payment_type') === 'cash') {
                                            $set('amount', $course->price);
                                        }
                                        if (in_array($get('payment_type'), ['installment', 'initial'])) {
                                            $set('number_of_installments', $course->duration_months);
                                            $remainingAmount = $course->price - ($get('amount') ?? 0);
                                            $installmentAmount = $remainingAmount / $course->duration_months;
                                            $set('installment_amount', round($installmentAmount, 2));
                                        }
                                    }
                                }
                            })
                            ->options(function (Forms\Get $get) {
                                if (!$get('student_id')) {
                                    return [];
                                }
                                return DB::table('tbl_course_students')
                                    ->where('student_id', $get('student_id'))
                                    ->join('tbl_courses', 'tbl_course_students.course_id', '=', 'tbl_courses.id')
                                    ->pluck('tbl_courses.name', 'tbl_courses.id');
                            })
                            ->searchable()
                            ->required(),

                        // Payment type
                        Forms\Components\Select::make('payment_type')
                            ->label(__('common.PaymentType'))
                            ->options([
                                'cash' => __('common.Cash'),
                                'installment' => __('common.Installment'),
                                'initial' => __('common.InitialPayment')
                            ])
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($state === 'cash' && $get('course_id')) {
                                    $course = Courses::find($get('course_id'));
                                    if ($course) {
                                        $set('amount', $course->price);
                                    }
                                } else if ($state === 'installment' && $get('course_id')) {
                                    $course = Courses::find($get('course_id'));
                                    if ($course) {
                                        $set('amount', 0);
                                        $set('number_of_installments', $course->duration);
                                        $installmentAmount = $course->price / $course->duration;
                                        $set('installment_amount', round($installmentAmount, 2));
                                    }
                                } else if ($state === 'initial') {
                                    $set('amount', null);
                                }
                            })
                            ->required(),

                        // Total amount (read-only)
                        Forms\Components\TextInput::make('total_amount')
                            ->label(__('common.TotalAmount'))
                            ->numeric()
                            ->readOnly()
                            ->prefix('$')
                            ->extraInputAttributes(['style' => 'opacity: 1; background-color: #f3f4f6;']),

                        // Amount field
                        Forms\Components\TextInput::make('amount')
                            ->label(__('common.Amount'))
                            ->numeric()
                            ->required()
                            ->prefix('$')
                            ->readOnly(fn (Forms\Get $get) => $get('payment_type') === 'cash' || $get('payment_type') === 'installment')
                            ->extraInputAttributes(['style' => 'opacity: 1; background-color: #f3f4f6;'])
                            ->live(debounce: 500)
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($get('payment_type') === 'initial' && $get('course_id')) {
                                    $course = Courses::find($get('course_id'));
                                    if ($course) {
                                        $amount = floatval($state ?? 0);
                                        if ($amount > $course->price) {
                                            $set('amount', $course->price);
                                            $amount = $course->price;
                                        }
                                        $remainingAmount = $course->price - $amount;
                                        $installmentAmount = $remainingAmount / ($get('number_of_installments') ?? $course->duration);
                                        $set('installment_amount', round($installmentAmount, 2));
                                    }
                                }
                            }),

                        // Number of installments
                        Forms\Components\TextInput::make('number_of_installments')
                            ->label(__('common.NumberInstallments'))
                            ->numeric()
                            ->required()
                            ->readOnly(fn (Forms\Get $get) => $get('payment_type') === 'cash')
                            ->visible(fn (Forms\Get $get) => in_array($get('payment_type'), ['installment', 'initial']))
                            ->extraInputAttributes(['style' => 'opacity: 1; background-color: #f3f4f6;'])
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($state && $get('course_id')) {
                                    $course = Courses::find($get('course_id'));
                                    if ($course) {
                                        if ($get('payment_type') === 'installment') {
                                            $installmentAmount = $course->price / $state;
                                        } else if ($get('payment_type') === 'initial') {
                                            $remainingAmount = $course->price - ($get('amount') ?? 0);
                                            $installmentAmount = $remainingAmount / $state;
                                        }
                                        $set('installment_amount', round($installmentAmount, 2));
                                    }
                                }
                            }),

                        // Installment amount (read-only)
                        Forms\Components\TextInput::make('installment_amount')
                            ->label(__('common.InstallmentAmount'))
                            ->numeric()
                            ->readOnly()
                            ->prefix('$')
                            ->extraInputAttributes(['style' => 'opacity: 1; background-color: #f3f4f6;'])
                            ->visible(fn (Forms\Get $get) => in_array($get('payment_type'), ['installment', 'initial'])),

                        // Payment date
                        Forms\Components\DatePicker::make('payment_date')
                            ->label(__('common.PaymentDate'))
                            ->required()
                            ->default(now()),

                        // Notes
                        Forms\Components\Textarea::make('notes')
                            ->label(__('common.Notes'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label(__('common.StudentName'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('course.name')
                    ->label(__('common.CourseName'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_amount')
                    ->label(__('common.TotalAmount'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_type')
                    ->label(__('common.PaymentType'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cash' => __('common.Cash'),
                        'installment' => __('common.Installment'),
                        'initial' => __('common.InitialPayment'),
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('payment_date')
                    ->label(__('common.PaymentDate'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('common.PaymentStatus'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'remaining' => 'warning',
                        default => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_type')
                    ->label(__('common.PaymentType'))
                    ->options([
                        'cash' => __('common.Cash'),
                        'installment' => __('common.Installment'),
                        'initial' => __('common.InitialPayment'),
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('common.PaymentStatus'))
                    ->options([
                        'paid' => __('common.Paid'),
                        'remaining' => __('common.Unpaid'),
                    ]),
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptionPayments::route('/'),
            'create' => Pages\CreateSubscriptionPayment::route('/create'),
            'edit' => Pages\EditSubscriptionPayment::route('/{record}/edit'),
        ];
    }

    public static function getBreadCrumb(): string
    {
        return __('common.SubscriptionPayments');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.SubscriptionPayments');
    }

    public static function getLabel(): string
    {
        return __('common.SubscriptionPayments');
    }

    public static function getModelLabel(): string
    {
        return __('common.SubscriptionPayment');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.SubscriptionPayments');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.SubscriptionPayments');
    }
}
