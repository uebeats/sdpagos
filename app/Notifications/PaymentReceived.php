<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Invoice;

class PaymentReceived extends Notification
{
    use Queueable;

    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Pago Recibido - NC #' . $this->invoice->id)
            ->greeting("Hola, {$notifiable->name}")
            ->line("Hemos recibido tu pago por la Nota de Cobro **#{$this->invoice->id}**.")
            ->line("Monto pagado: **CLP {$this->invoice->total_amount}**")
            ->line("Gracias por tu pago. Tu servicio sigue activo.")
            ->action('Ver Nota de Cobro', url('/chargenote/' . $this->invoice->id))
            ->line('Si tienes alguna consulta, contáctanos.');
    }
}