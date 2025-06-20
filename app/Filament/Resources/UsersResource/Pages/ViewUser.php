<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Password;
use Filament\Forms\Components\Same;
use Filament\Forms\Components\Form;

class ViewUser extends ViewRecord
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('changePassword')
                ->label(__('common.change_password'))
                ->icon('heroicon-o-key')
                ->form([
                    TextInput::make('current_password')
                        ->label(__('common.current_password'))
                        ->password()
                        ->required()
                        ->rule('current_password'),
                    TextInput::make('new_password')
                        ->label(__('common.new_password'))
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->same('password_confirmation'),
                    TextInput::make('password_confirmation')
                        ->label(__('common.confirm_password'))
                        ->password()
                        ->required()
                        ->minLength(8),
                ])
                ->action(function (array $data) {
                    $this->record->updatePassword($data['new_password']);
                    Notification::make()
                        ->title(__('common.password_changed_success'))
                        ->success()
                        ->send();
                }),
            Actions\Action::make('toggleStatus')
                ->label(fn () => $this->record->is_active === 1 ? __('common.deactivate') : __('common.activate'))
                ->icon(fn () => $this->record->is_active === 1 ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                ->color(fn () => $this->record->is_active === 1 ? 'danger' : 'success')
                ->action(function () {
                    $this->record->update([
                        'is_active' => $this->record->is_active === 1 ? 0 : 1,
                    ]);
                    Notification::make()
                        ->title($this->record->is_active === 1 ? __('common.user_activated') : __('common.user_deactivated'))
                        ->success()
                        ->send();
                }),
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label(__('common.name')),
                        Infolists\Components\TextEntry::make('email')
                            ->label(__('common.email')),
                        Infolists\Components\TextEntry::make('roles.name')
                            ->label(__('common.roles'))
                            ->badge(),
                        Infolists\Components\IconEntry::make('is_active')
                            ->label(__('common.is_active'))
                            ->boolean()
                            ->getStateUsing(fn ($record) => $record->is_active === 1)
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label(__('common.created_at'))
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
} 