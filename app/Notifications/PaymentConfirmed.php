<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Payment;

class PaymentConfirmed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmación de Pago')
            ->greeting("Hola, {$notifiable->name}")
            ->line("Tu pago de **\${$this->payment->amount}** ha sido confirmado para el servicio **{$this->payment->subscription->service->name}**.")
            ->line("Gracias por tu pago.")
            ->salutation('Saludos, Sistema de Cobros');
    }
}