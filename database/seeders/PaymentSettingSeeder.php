<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use Illuminate\Database\Seeder;

class PaymentSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (PaymentSetting::count() === 0) {
            PaymentSetting::create([
                'title' => 'Fonepay / eSewa Payment QR',
                'payment_image' => null, // Admin will upload QR image or set link
                'instructions' => "1. Open your Fonepay, eSewa, or Mobile Banking app.\n2. Scan the QR code displayed on the left.\n3. Complete the payment of NPR 1,000.\n4. Take a screenshot of the payment receipt.\n5. Upload the receipt screenshot below to confirm your appointment.",
                'amount' => 'NPR 1,000',
                'account_name' => 'Omma Health Center Pvt. Ltd.',
                'account_number' => '9800000000 / 012345678910',
                'is_active' => true,
            ]);
        }
    }
}
