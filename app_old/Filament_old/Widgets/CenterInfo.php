<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CenterInfo extends BaseWidget
{


    protected function getCards(): array
    {
        $systemName = 'smart_center';
        $systemVersion = '1.0.0';
        $customerServicePhone = '0123456789';
        $customerServiceEmail = 'support@yourcompany.com';
        $lastUpdate = Carbon::create(2024, 1, 1);
        $monthsSinceUpdate = $lastUpdate->diffInMonths(Carbon::now());
        $updateStatus = $monthsSinceUpdate >= 3 ? 'تحديث مطلوب' : 'حديث';

        return [
            Card::make('معلومات النظام والدعم', '')
                ->icon('heroicon-o-information-circle')
                ->color('primary')
                ->extraAttributes([
                    'style' => 'width: 100%;',
                    'class' => 'col-span-full',
                ])
                ->description(view('system-info-card', [
                    'systemName' => $systemName,
                    'systemVersion' => $systemVersion,
                    'customerServicePhone' => $customerServicePhone,
                    'customerServiceEmail' => $customerServiceEmail,
                    'lastUpdate' => $lastUpdate->format('Y-m-d'),
                    'monthsSinceUpdate' => $monthsSinceUpdate,
                    'updateStatus' => $updateStatus,
                    'isUpdateRequired' => $monthsSinceUpdate >= 3,
                ]))
        ];
    }

}
