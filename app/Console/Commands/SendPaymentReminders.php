<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;
use App\Notifications\PaymentReminder;

class SendPaymentReminders extends Command
{
    protected $signature = 'payments:remind';
    protected $description = 'Enviar recordatorios de pagos pendientes';

    public function handle()
    {
        $subscriptions = Subscription::where('status', 'pending')
            ->whereDate('next_billing_date', '<=', Carbon::now()->addDays(3))
            ->with('client')
            ->get();

        foreach ($subscriptions as $subscription) {
            if ($subscription->client) {
                $subscription->client->notify(new PaymentReminder($subscription));
            }
        }

        $this->info('Recordatorios de pago enviados correctamente.');
    }
}