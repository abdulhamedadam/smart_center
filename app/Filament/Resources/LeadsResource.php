<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadsResource\Pages;
use App\Filament\Resources\LeadsResource\RelationManagers;
use App\Models\CrmLeads;
use App\Models\Leads;
use App\Models\Courses;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeadsResource extends Resource
{
    protected static ?string $model = CrmLeads::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?int $navigationSort = 13;
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationGroup(): ?string
    {
        return __('common.crm');
    }
    public static function getGlobalSearchResultDetails($model): array
    {
        return [
            'Course' => $model->course->name ?? 'No course',
            'Status' => $model->status,
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->label(__('common.name')),
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(20)
                                    ->label(__('common.phone')),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255)
                                    ->label(__('common.email')),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('course_id')
                                    ->label(__('common.course'))
                                    ->options(Courses::pluck('name', 'id'))
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\Select::make('source')
                                    ->label(__('common.source'))
                                    ->options(CrmLeads::getSourceLabels())
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->label(__('common.status'))
                                    ->options(CrmLeads::getStatusLabels())
                                    ->default(CrmLeads::STATUS_NEW)
                                    ->required(),
                            ]),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('assigned_to')
                                    ->label(__('common.AssignedTo'))
                                    ->options(User::pluck('name', 'id'))
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\DatePicker::make('first_contact_date')
                                    ->label(__('common.first_contact_date'))
                                    ->required(),
                            ]),

                        Forms\Components\Textarea::make('note')
                            ->label(__('common.notes'))
                            ->maxLength(65535)
                            ->columnSpan('full'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('common.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('common.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('common.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('course.name')
                    ->label(__('common.course'))
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('common.status'))
                    ->colors([
                        'primary' => CrmLeads::STATUS_NEW,
                        'warning' => CrmLeads::STATUS_CONTACTED,
                        'info' => CrmLeads::STATUS_NEEDS_FOLLOWUP,
                        'success' => CrmLeads::STATUS_REGISTERED,
                        'danger' => CrmLeads::STATUS_NOT_INTERESTED,
                    ])
                    ->formatStateUsing(fn ($state) => CrmLeads::getStatusLabels()[$state] ?? __('common.unknown'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('source')
                    ->label(__('common.source'))
                    ->formatStateUsing(fn ($state) => CrmLeads::getSourceLabels()[$state] ?? __('common.unknown'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->label(__('common.AssignedTo'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_contact_date')
                    ->label(__('common.first_contact_date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        CrmLeads::NEW => 'New',
                        CrmLeads::CONTACTED => 'Contacted',
                        CrmLeads::CONVERTED => 'Converted',
                        CrmLeads::NOTINTERSTED => 'Not Interested',
                        CrmLeads::LOST => 'Lost',
                    ]),
                Tables\Filters\SelectFilter::make('source')
                    ->options([
                        'website' => 'Website',
                        'social' => 'Social Media',
                        'referral' => 'Referral',
                        'advertisement' => 'Advertisement',
                        'other' => 'Other',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
        return [
          //  RelationManagers\FollowUpsRelationManager::class,
         //   RelationManagers\NotesRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageLeads::route('/'),
        ];
    }


    // LOCALIZATION =====================================================================
    // LOCALIZATION =====================================================================
    // LOCALIZATION =====================================================================


    public static function getBreadCrumb(): string
    {
        return __('common.leads');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.leads');
    }

    public static function getLabel(): string
    {
        return __('common.leads');
    }

    public static function getModelLabel(): string
    {
        return __('common.lead');
    }

    public static function getPluralModelLabel(): string
    {
        return __('common.leads');
    }

    public static function getNavigationLabel(): string
    {
        return __('common.leads');
    }
}
