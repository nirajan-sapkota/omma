<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Patient')
                    ->disabled()
                    ->required(),

                Select::make('category')
                    ->options([
                        'online' => 'Online Appointment',
                        'physical' => 'In-Person Appointment',
                    ])
                    ->required(),

                DatePicker::make('appointment_date')
                    ->required(),

                TextInput::make('appointment_time')
                    ->required(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),

                Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending Verification',
                        'paid' => 'Paid / Verified',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),

                TextInput::make('payment_reference')
                    ->label('Payment Reference / Txn ID'),

                FileUpload::make('payment_receipt')
                    ->label('Uploaded Payment Receipt')
                    ->image()
                    ->disk('public')
                    ->directory('receipts')
                    ->disabled(),
            ]);
    }
}
