<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentsResource\Pages;
use App\Filament\Resources\StudentsResource\RelationManagers;
use App\Models\Students;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentsResource extends Resource
{
    protected static ?string $model = Students::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $sort = 1;
    public static function getNavigationGroup(): string
    {
        return __('common.users_management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('common.PersonalInformation'))
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label(__('common.FullName'))
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('common.Email'))
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('common.Phone'))
                            ->tel()
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->label(__('common.Gender'))
                            ->options([
                                'male' => __('common.Male'),
                                'female' => __('common.Female'),
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label(__('common.DateOfBirth'))
                            ->required(),

                        Forms\Components\TextInput::make('address')
                            ->label(__('common.Address'))
                            ->required(),
                    ])
                    ->columns(3),


                Forms\Components\Section::make(__('common.GuardianInformation'))
                    ->schema([
                        Forms\Components\TextInput::make('guardian_name')
                            ->label(__('common.GuardianName'))
                            ->required(),
                        Forms\Components\TextInput::make('guardian_phone')
                            ->label(__('common.GuardianPhone'))
                            ->tel()
                            ->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make(__('common.AdditionalInformation'))
                    ->schema([
                        Forms\Components\DatePicker::make('registration_date')
                            ->label(__('common.RegistrationDate'))
                            ->default(\Carbon\Carbon::now())
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label(__('common.Status'))
                            ->options([
                                1 => __('common.Active'),
                                0 => __('common.Inactive'),
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label(__('common.Notes')),
                        SpatieMediaLibraryFileUpload::make('students')
                            ->collection('students')
                            ->label(__('common.Image'))
                            ->image()
                            ->responsiveImages()
                            ->disk('public')
                            ->rules(['image', 'max:2048']),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('common.FullName'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('common.Email'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('common.Phone'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('common.Gender'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label(__('common.DateOfBirth'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('common.Address'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('guardian_name')
                    ->label(__('common.GuardianName'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('guardian_phone')
                    ->label(__('common.GuardianPhone'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('registration_date')
                    ->label(__('common.RegistrationDate'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('common.Status')),

                Tables\Columns\TextColumn::make('notes')
                    ->label(__('common.Notes'))
                    ->limit(50),
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('common.Image'))
                    ->collection('students')
                    ->disk('')
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('details')
                        ->label(__('common.Details'))
                        ->icon('heroicon-o-document-text')
                        ->url(fn($record) => static::getUrl('details', ['record' => $record])),

                    Tables\Actions\Action::make('courses')
                        ->label(__('common.courses'))
                        ->icon('heroicon-o-book-open')
                        ->url(fn($record) => static::getUrl('courses', ['record' => $record])),

                    Tables\Actions\Action::make('schedules')
                        ->label(__('common.schedules'))
                        ->icon('heroicon-o-calendar')
                        ->url(fn($record) => static::getUrl('schedules', ['record' => $record])),

                    Tables\Actions\Action::make('attendance')
                        ->label(__('common.attendance'))
                        ->icon('heroicon-o-user-group')
                        ->url(fn($record) => static::getUrl('attendance', ['record' => $record])),

                    Tables\Actions\Action::make('payments')
                        ->label(__('common.payments'))
                        ->icon('heroicon-o-currency-dollar')
                        ->url(fn($record) => static::getUrl('payments', ['record' => $record])),

                    Tables\Actions\Action::make('tests')
                        ->label(__('common.tests'))
                        ->icon('heroicon-o-clipboard-document-check')
                        ->url(fn($record) => static::getUrl('tests', ['record' => $record])),

                    Tables\Actions\Action::make('assignments')
                        ->label(__('common.assignments'))
                        ->icon('heroicon-o-document')
                        ->url(fn($record) => static::getUrl('assignments', ['record' => $record])),
                ])
                    ->icon('heroicon-m-ellipsis-vertical'),
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
            'create' => Pages\CreateStudents::route('/create'),
            'index' => Pages\ListStudents::route('/'),
            'edit' => Pages\EditStudents::route('/{record}/edit'),
            'details' => Pages\StudentDetails::route('/{record}/details'),
            'courses' => Pages\Courses::route('/{record}/courses'),
            'schedules' => Pages\Schedules::route('/{record}/schedules'),
            'attendance' => Pages\Attendance::route('/{record}/attendance'),
            'payments' => Pages\Payments::route('/{record}/payments'),
            'tests' => Pages\Tests::route('/{record}/tests'),
            'assignments' => Pages\Assigments::route('/{record}/assignments'),
        ];
    }



    public static function getBreadCrumb(): string
    {
        return __('common.students');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.students');
    }

    public static function getLabel(): string
    {
        return __('common.students');
    }

    public static function getModelLabel(): string
    {
        return __('common.student');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.students');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.students');
    }
}
