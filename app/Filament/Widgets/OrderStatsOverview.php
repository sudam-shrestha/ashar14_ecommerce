<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->description('All orders placed')
                ->descriptionIcon(Heroicon::OutlinedShoppingBag)
                ->color('primary'),

            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Awaiting processing')
                ->descriptionIcon(Heroicon::OutlinedClock)
                ->color('warning'),

            Stat::make('Delivered Orders', Order::where('status', 'delivered')->count())
                ->description('Successfully completed')
                ->descriptionIcon(Heroicon::OutlinedCheckCircle)
                ->color('success'),

            Stat::make('Cancelled Orders', Order::where('status', 'cancelled')->count())
                ->description('Cancelled or failed')
                ->descriptionIcon(Heroicon::OutlinedXCircle)
                ->color('danger'),

            Stat::make('Total Revenue', 'NRs. ' . number_format(
                Order::where('payment_status', true)->sum('total_amount'),
                2
            ))
                ->description('From paid orders')
                ->descriptionIcon(Heroicon::OutlinedBanknotes)
                ->color('success'),

            Stat::make('Unpaid Amount', 'NRs. ' . number_format(
                Order::where('payment_status', false)->sum('total_amount'),
                2
            ))
                ->description('Awaiting payment')
                ->descriptionIcon(Heroicon::OutlinedExclamationTriangle)
                ->color('danger'),
        ];
    }
}
