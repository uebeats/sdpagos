<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Notifications\InvoiceGenerated;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'service_id', 'status', 'start_date', 'next_payment_date'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($subscription) {
            // Crear la primera factura al momento de la suscripción
            $invoice = Invoice::create([
                'client_id' => $subscription->client_id,
                'subscription_id' => $subscription->id,
                'total_amount' => $subscription->service->price,
                'due_date' => Carbon::parse($subscription->start_date), // Fecha de contratación
                'status' => 'unpaid',
            ]);

            // Enviar notificación al cliente
            $client = $subscription->client;
            $client->notify(new InvoiceGenerated($invoice));
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}