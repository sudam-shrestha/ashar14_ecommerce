<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Information')
                    ->description('Reference details set at checkout. These cannot be changed here.')
                    ->icon(Heroicon::OutlinedClipboardDocumentList)
                    ->columns(2)
                    ->components([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Customer')
                            ->prefixIcon(Heroicon::OutlinedUser)
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),
                        Select::make('dokan_id')
                            ->relationship('dokan', 'dokan_name')
                            ->label('Vendor')
                            ->prefixIcon(Heroicon::OutlinedBuildingStorefront)
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),
                        TextInput::make('total_amount')
                            ->label('Total Amount')
                            ->numeric()
                            ->prefix('NRs.')
                            ->prefixIcon(Heroicon::OutlinedBanknotes)
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),
                        Select::make('payment_method')
                            ->options([
                                'cod' => 'Cash on Delivery',
                                'khalti' => 'Khalti',
                            ])
                            ->prefixIcon(Heroicon::OutlinedCreditCard)
                            ->disabled()
                            ->dehydrated(false)
                            ->required(),
                    ]),

                Section::make('Status Management')
                    ->description('Update the order and payment status.')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->columns(2)
                    ->components([
                        Select::make('status')
                            ->label('Order Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->prefixIcon(Heroicon::OutlinedArrowPath)
                            ->native(false)
                            ->default('pending')
                            ->required(),
                        Toggle::make('payment_status')
                            ->label('Payment Received')
                            ->onIcon(Heroicon::OutlinedCheckCircle)
                            ->offIcon(Heroicon::OutlinedXCircle)
                            ->required(),
                    ]),
            ]);
    }
}
