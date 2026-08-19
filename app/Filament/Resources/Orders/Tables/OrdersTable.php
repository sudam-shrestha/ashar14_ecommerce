<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Order #')
                    ->formatStateUsing(fn (int $state): string => '#' . str_pad((string) $state, 6, '0', STR_PAD_LEFT))
                    ->icon(Heroicon::OutlinedHashtag)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->icon(Heroicon::OutlinedUser)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dokan.dokan_name')
                    ->label('Vendor')
                    ->icon(Heroicon::OutlinedBuildingStorefront)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn (float $state): string => 'NRs. ' . number_format($state, 2))
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->sortable(),
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->selectablePlaceholder(false)
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Payment')
                    ->badge()
                    ->icon(Heroicon::OutlinedCreditCard)
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'cod' => 'Cash on Delivery',
                        'khalti' => 'Khalti',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'khalti' => 'info',
                        default => 'gray',
                    }),
                ToggleColumn::make('payment_status')
                    ->label('Paid'),
                TextColumn::make('created_at')
                    ->label('Placed')
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
                SelectFilter::make('payment_method')
                    ->options([
                        'cod' => 'Cash on Delivery',
                        'khalti' => 'Khalti',
                    ]),
                TernaryFilter::make('payment_status')
                    ->label('Payment Received'),
            ])
            ->recordActions([
                EditAction::make()
                    ->icon(Heroicon::OutlinedPencilSquare),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->icon(Heroicon::OutlinedTrash),
                ]),
            ]);
    }
}
