<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Notifications\InvoiceGenerated;
use Carbon\Carbon;

class GenerateInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Genera facturas automáticamente para las suscripciones activas.';

    public function handle()
    {
        $today = Carbon::today();

        // Buscar suscripciones activas con próxima fecha de pago igual a hoy
        $subscriptions = Subscription::where('status', 'active')
            ->whereDate('next_payment_date', $today)
            ->get();

        foreach ($subscriptions as $subscription) {
            $invoiceExists = Invoice::where('subscription_id', $subscription->id)
                ->where('due_date', $subscription->next_payment_date)
                ->exists();

            if (!$invoiceExists) {
                // Crear nueva factura
                $invoice = Invoice::create([
                    'client_id' => $subscription->client_id,
                    'subscription_id' => $subscription->id,
                    'total_amount' => $subscription->service->price,
                    'due_date' => $subscription->next_payment_date,
                    'status' => 'unpaid',
                ]);

                // Enviar notificación al cliente sobre la nueva factura
                $client = $subscription->client;
                $client->notify(new InvoiceGenerated($invoice));

                // Actualizar la próxima fecha de pago según el ciclo de facturación
                $nextPaymentDate = match ($subscription->service->billing_cycle) {
                    'monthly' => Carbon::parse($subscription->next_payment_date)->addMonth(),
                    'quarterly' => Carbon::parse($subscription->next_payment_date)->addMonths(3),
                    'yearly' => Carbon::parse($subscription->next_payment_date)->addYear(),
                };

                $subscription->update(['next_payment_date' => $nextPaymentDate]);
                
                $this->info("Factura generada para la suscripción ID: {$subscription->id}");
            }
        }

        $this->info('Proceso de facturación completado.');
    }
}