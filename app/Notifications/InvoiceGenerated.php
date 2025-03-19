<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Invoice;

class InvoiceGenerated extends Notification
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
            ->subject('Nueva Nota de Cobro Generada')
            ->greeting("Hola, {$notifiable->name}")
            ->line("Se ha generado una nueva Nota de Cobro con un total de **{$this->invoice->total_amount}**.")
            ->action('Ver Nota de Cobro', url('/chargenote/' . $this->invoice->id))
            ->line('Por favor, realice el pago antes de la fecha de vencimiento.')
            ->line("Fecha de vencimiento: {$this->invoice->due_date->format('d-m-Y')}");
    }
}