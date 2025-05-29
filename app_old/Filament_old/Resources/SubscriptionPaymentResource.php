<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionPaymentResource\Pages;
use App\Filament\Resources\SubscriptionPaymentResource\RelationManagers;
use App\Models\CoursePayments;
use App\Models\Courses;
use App\Models\Students;
use App\Models\SubscriptionPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class SubscriptionPaymentResource extends Resource
{
    protected static ?string $model = CoursePayments::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): string
    {
        return __('common.Financial');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('معلومات الدفع')
                    ->schema([
                        Forms\Components\Select::make('student_id')
                            ->label(__('common.Student'))
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('course_id', null);
                            })
                            ->options(Students::query()->pluck('full_name', 'id')) // Direct query
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('course_id')
                            ->label(__('common.Course'))
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $set('total_price', null);
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

                        Forms\Components\Select::make('payment_type')
                            ->label('نوع الدفع')
                            ->options([
                                'cash' => 'كاش',
                                'installment' => 'تقسيط',
                                'initial' => 'دفعة أولية'
                            ])
                            ->live()
                            ->required(),

                        Forms\Components\TextInput::make('amount')
                            ->label('المبلغ')
                            ->numeric()
                            ->required()
                            ->prefix('$'),

                        Forms\Components\TextInput::make('total_amount')
                            ->label('المبلغ الإجمالي')
                            ->numeric()
                            ->disabled()
                            ->prefix('$'),

                        Forms\Components\DatePicker::make('payment_date')
                            ->label('تاريخ الدفع')
                            ->required()
                            ->default(now()),

                        Forms\Components\Textarea::make('notes')
                            ->label('ملاحظات')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('تفاصيل التقسيط')
                    ->schema([
                        Forms\Components\Repeater::make('installments')
                            ->label('الأقساط')
                            ->schema([
                                Forms\Components\TextInput::make('amount')
                                    ->label('المبلغ')
                                    ->numeric()
                                    ->required(),

                                Forms\Components\DatePicker::make('due_date')
                                    ->label('تاريخ الاستحقاق')
                                    ->required(),
                            ])
                            ->visible(fn (Forms\Get $get) => in_array($get('payment_type'), ['installment', 'initial']))
                            ->columns(2)
                            ->columnSpanFull(),
                    ])
                    ->hidden(fn (Forms\Get $get) => $get('payment_type') === 'cash'),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptionPayments::route('/'),
            //'create' => Pages\CreateSubscriptionPayment::route('/create'),
           // 'edit' => Pages\EditSubscriptionPayment::route('/{record}/edit'),
        ];
    }
    //------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------
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
