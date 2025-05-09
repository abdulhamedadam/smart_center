<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructorResource\Pages;
use App\Filament\Resources\InstructorResource\RelationManagers;
use App\Models\City;
use App\Models\Country;
use App\Models\Instructor;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InstructorResource extends Resource
{
    protected static ?string $model = Instructor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make()
                    ->columns(3)
                    ->schema([
                        // Row 1
                        TextInput::make('name')
                            ->label(__('common.name'))
                            ->nullable(),

                        TextInput::make('email')
                            ->label(__('common.email'))
                            ->email()
                            ->nullable(),

                        TextInput::make('phone')
                            ->label(__('common.phone'))
                            ->tel()
                            ->nullable(),

                        // Row 2
                        Select::make('city_id')
                            ->label(__('common.city_id'))
                            ->options(Country::whereNull('parent_id')->pluck('name', 'id'))
                            ->live()
                            ->nullable()
                            ->suffixAction(
                                Action::make('addCity')
                                    ->icon('heroicon-o-plus')
                                    ->form([
                                        TextInput::make('name')
                                            ->required()
                                            ->label(__('common.Name')),

                                    ])
                                    ->action(function (array $data) {
                                        $country = Country::create([
                                            'name' => $data['name'],
                                            'parent_id' => null,
                                        ]);


                                    })
                            ),

                        Select::make('region_id')
                            ->label(__('common.region_id'))
                            ->options(function (Get $get) {
                                $cityId = $get('city_id');
                                if (!$cityId) {
                                    return [];
                                }
                                return City::where('parent_id', $cityId)->pluck('name', 'id');
                            })
                            ->nullable()
                            ->suffixAction(
                                Action::make('addRegion')
                                    ->icon('heroicon-o-plus')
                                    ->form([
                                        Forms\Components\Grid::make(2) // This creates a 2-column layout
                                        ->schema([
                                            Forms\Components\Select::make('parent_id')
                                                ->options(
                                                    City::whereNull('parent_id')
                                                        ->pluck('name', 'id')
                                                )
                                                ->searchable()
                                                ->preload()
                                                ->required()
                                                ->label(__('common.Country'))
                                                ->native(false),
                                            TextInput::make('name')
                                                ->required()
                                                ->label(__('common.Name')),
                                        ]),
                                    ])
                                    ->action(function (array $data) {
                                        $record['name']=$data['name'];
                                        $record['parent_id']=$data['parent_id'];
                                       // dd($record);
                                        $region = City::create($record);
                                    })
                            ),
                        TextInput::make('address1')
                            ->label(__('common.address1'))
                            ->nullable(),


                        TextInput::make('experience')
                            ->label(__('common.experience'))
                            ->numeric()
                            ->nullable(),

                        TextInput::make('qualifications')
                            ->label(__('common.qualifications'))
                            ->nullable(),


                        SpatieMediaLibraryFileUpload::make('instructor')
                            ->collection('instructor')
                            ->label(__('common.Image'))
                            ->image()
                            ->responsiveImages()
                            ->disk('public')
                            ->rules(['image', 'max:2048']),


                        // Row 5
                        TextInput::make('course_percentage')
                            ->label(__('common.course_percentage'))
                            ->numeric()
                            ->suffix('%')
                            ->nullable(),

                        Textarea::make('bio')
                            ->label(__('common.bio'))
                            ->columnSpanFull()
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('common.Image'))
                    ->collection('instructor')
                    ->disk('')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('common.name'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                TextColumn::make('email')
                    ->label(__('common.email'))
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('phone')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label(__('common.phone')),

                TextColumn::make('Country.name')
                    ->label(__('common.Country'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                TextColumn::make('City.name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('common.City')),

                TextColumn::make('experience')
                    ->label(__('common.experience'))
                    ->suffix(' yrs')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

                TextColumn::make('course_percentage')
                    ->label(__('common.course_percentage'))
                    ->suffix('%')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city')
                    ->relationship('Country', 'name')
                    ->label(__('common.Country')),

                Tables\Filters\SelectFilter::make('region')
                    ->relationship('City', 'name')
                    ->label(__('common.City')),
            ])
            ->actions([

                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('details')
                        ->label(__('common.Details'))
                        ->icon('heroicon-o-eye')
                        ->url(fn($record) => static::getUrl('details', ['record' => $record])),

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
            'index' => Pages\ListInstructors::route('/'),
            'create' => Pages\CreateInstructor::route('/create'),
            'edit' => Pages\EditInstructor::route('/{record}/edit'),
            'details' => Pages\InstructorDetails::route('/{record}/details'),
        ];
    }


    // LOCALIZATION =====================================================================
    // LOCALIZATION =====================================================================
    // LOCALIZATION =====================================================================


    public static function getBreadCrumb(): string
    {
        return __('common.instructors');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.instructors');
    }

    public static function getLabel(): string
    {
        return __('common.instructors');
    }

    public static function getModelLabel(): string
    {
        return __('common.instructor');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.instructors');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.instructors');
    }
}
