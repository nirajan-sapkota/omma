<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Patient Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'info',
                        'physical' => 'success',
                        default => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('appointment_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('appointment_time')
                    ->label('Time')
                    ->sortable(),

                ImageColumn::make('payment_receipt')
                    ->label('Payment Receipt')
                    ->disk('public')
                    ->square(),

                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'verified' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Booking Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('meet_link')
                    ->label('Meet Link')
                    ->url(fn (\App\Models\Booking $record) => $record->meet_link)
                    ->openUrlInNewTab()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Booked On')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('join')
                    ->label('Join')
                    ->url(fn (\App\Models\Booking $record) => $record->meet_link)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-video-camera'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
