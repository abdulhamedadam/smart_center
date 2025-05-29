<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadsResource\Pages;
use App\Filament\Resources\LeadsResource\RelationManagers;
use App\Models\CrmLeads;
use App\Models\Leads;
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
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                                    ->options(
                                        \App\Models\Courses::pluck('name', 'id')
                                    )
                                    ->searchable(),


                                Forms\Components\TextInput::make('source')
                                    ->label(__('common.source')),


                                Forms\Components\Select::make('assigned_to')
                                    ->label(__('common.AssignedTo'))
                                    ->options(
                                        \App\Models\User::pluck('name', 'id')
                                    )
                                    ->searchable(),
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
                    ->searchable()
                    ->label(__('common.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('common.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('common.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('course.name')
                    ->label(__('common.course_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label(__('common.status'))
                    ->colors([
                        'primary' => CrmLeads::NEW,
                        'warning' => CrmLeads::CONTACTED,
                        'success' => CrmLeads::CONVERTED,
                        'danger' => CrmLeads::NOTINTERSTED.','.CrmLeads::LOST,
                    ])
                    ->formatStateUsing(fn ($state) => [
                        CrmLeads::NEW => 'New',
                        CrmLeads::CONTACTED => 'Contacted',
                        CrmLeads::CONVERTED => 'Converted',
                        CrmLeads::NOTINTERSTED => 'Not Interested',
                        CrmLeads::LOST => 'Lost',
                    ][$state]),
                Tables\Columns\TextColumn::make('source')
                      ->label(__('common.source')),
                Tables\Columns\TextColumn::make('assignee.name')
                    ->label(__('common.AssignedTo')),

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
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
