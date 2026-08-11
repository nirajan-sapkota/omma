<?php

namespace App\Filament\Resources\PaymentSettings\Pages;

use App\Filament\Resources\PaymentSettings\PaymentSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Schema;
use App\Models\PaymentSetting;
use Illuminate\Database\Eloquent\Builder;

class ListPaymentSettings extends ListRecords
{
    protected static string $resource = PaymentSettingResource::class;

    /**
     * Override the default query so the page does not crash if the
     * `payment_settings` table has not been created yet.
     */
    protected function getTableQuery(): Builder
    {
        // If the table does not exist, return an empty query set.
        if (! Schema::hasTable('payment_settings')) {
            return PaymentSetting::query()->whereRaw('1 = 0');
        }

        // Otherwise, use the normal query.
        return parent::getTableQuery();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
