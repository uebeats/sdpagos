<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\Payment;
use App\Notifications\PaymentReminder;
use Carbon\Carbon;

class GenerateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera notas de cobro para los clientes con suscripciones activas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptions = Subscription::where('status', 'active')
            ->where('next_billing_date', '<=', Carbon::today())
            ->get();

        foreach ($subscriptions as $subscription) {
            // Crear el pago pendiente
            $payment = Payment::create([
                'client_id' => $subscription->client_id,
                'subscription_id' => $subscription->id,
                'amount' => $subscription->amount,
                'payment_date' => Carbon::now(),
                'status' => 'pending',
                'payment_method' => null
            ]);

            $subscription->client->notify(new PaymentReminder($payment));

            // Actualizar la fecha del próximo cobro
            $nextBillingDate = match ($subscription->billing_cycle) {
                'monthly' => Carbon::now()->addMonth(),
                'quarterly' => Carbon::now()->addMonths(3),
                'annually' => Carbon::now()->addYear(),
            };

            $subscription->update(['next_billing_date' => $nextBillingDate]);

            $this->info("Nota de cobro generada y notificación enviada para cliente ID: {$subscription->client_id}");
        }
    }
}
