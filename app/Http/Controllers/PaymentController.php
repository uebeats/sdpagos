<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Notifications\PaymentConfirmed;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('subscription.client')->latest()->paginate(10);
        return view('payments.index', compact('payments'));
        // return response()->json($payments);
    }

    public function create()
    {
        $subscriptions = Subscription::with('client', 'service')->where('status', 'pending')->get();
        return view('payments.create', compact('subscriptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:transfer,mercadopago,webpay,paypal',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,failed,successful',
            'paid_at' => 'nullable|date',
        ]);

        $payment = Payment::create($request->all());

        // Actualizar el estado de la suscripción si el pago fue exitoso
        if ($payment->status === 'successful') {
            $subscription = $payment->subscription;
            $billing_cycle = $subscription->service->billing_cycle;
    
            // Determinar la nueva fecha de facturación según el ciclo de pago
            switch ($billing_cycle) {
                case 'monthly':
                    $next_billing_date = now()->addMonth();
                    break;
                case 'quarterly':
                    $next_billing_date = now()->addMonths(3);
                    break;
                case 'semi-annually':
                    $next_billing_date = now()->addMonths(6);
                    break;
                case 'annually':
                    $next_billing_date = now()->addYear();
                    break;
                default:
                    $next_billing_date = now()->addMonth(); // Fallback
            }
    
            $subscription->update([
                'status' => 'paid',
                'next_billing_date' => $next_billing_date,
            ]);
    
            // Enviar notificación al cliente
            $subscription->client->notify(new PaymentConfirmed($payment));
        }

        return redirect()->route('payments.index')->with('success', 'Pago registrado correctamente.');
    }

    public function edit(Payment $payment)
    {
        $subscriptions = Subscription::with('client', 'service')->get();
        return view('payments.edit', compact('payment', 'subscriptions'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:transfer,mercadopago,webpay,paypal',
            'transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,failed,successful',
            'paid_at' => 'nullable|date',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pago eliminado correctamente.');
    }
}