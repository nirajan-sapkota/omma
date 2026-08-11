<?php

namespace App\Filament\Resources\PaymentSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PaymentSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Payment Option Title')
                    ->required()
                    ->placeholder('e.g. Fonepay / eSewa QR Code'),

                FileUpload::make('payment_image')
                    ->label('Payment QR / Instructions Image')
                    ->image()
                    ->directory('payments')
                    ->disk('public')
                    ->imageEditor()
                    ->helperText('Upload the QR Code image that patients will scan to make payment.'),

                TextInput::make('amount')
                    ->label('Fee / Price')
                    ->placeholder('e.g. NPR 1,000')
                    ->required(),

                TextInput::make('account_name')
                    ->label('Account Holder Name')
                    ->placeholder('e.g. Omma Health Center'),

                TextInput::make('account_number')
                    ->label('Account / Phone Number')
                    ->placeholder('e.g. 9800000000'),

                Textarea::make('instructions')
                    ->label('Payment Instructions')
                    ->rows(4)
                    ->placeholder('Instructions for patient payment...'),

                Toggle::make('is_active')
                    ->label('Is Active?')
                    ->default(true),
            ]);
    }
}
