<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Subscription;

class PaymentReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recordatorio de Pago Pendiente')
            ->greeting("Hola, {$notifiable->name}")
            ->line("Tienes un pago pendiente para el servicio: **{$this->subscription->service->name}**.")
            ->line("Monto a pagar: **\${$this->subscription->service->price}**")
            ->line("Fecha límite de pago: **{$this->subscription->next_billing_date}**")
            ->action('Realizar Pago', url('/'))
            ->line('Si ya realizaste el pago, ignora este mensaje.')
            ->salutation('Saludos, Sistema de Cobros');
    }
}