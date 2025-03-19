<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use MercadoPago;
use Illuminate\Support\Facades\Log;
use App\Notifications\PaymentReceived;

class PaymentController extends Controller
{
    public function payWithMercadoPago(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        MercadoPago\SDK::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));

        // Crear la preferencia de pago
        $preference = new MercadoPago\Preference();
        $item = new MercadoPago\Item();
        $item->title = "Pago de Factura #" . $invoice->id;
        $item->quantity = 1;
        $item->currency_id = "CLP";
        $item->unit_price = (float)$invoice->total_amount;

        $preference->items = [$item];
        $preference->back_urls = [
            "success" => route('payment.success', ['invoice' => $invoice->id]),
            "failure" => route('payment.failed', ['invoice' => $invoice->id]),
        ];
        $preference->auto_return = "approved";
        $preference->save();

        return redirect($preference->init_point);
    }

    public function paymentSuccess(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->update(['status' => 'paid']);

        // Enviar notificación al cliente
        $client = $invoice->client;
        $client->notify(new PaymentReceived($invoice));

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Pago realizado con éxito. Se ha enviado una confirmación por email.');
    }

    public function paymentFailed(Request $request, $invoiceId)
    {
        return redirect()->route('invoices.show', $invoiceId)
            ->with('error', 'El pago no se completó.');
    }

    public function manualPaymentConfirm(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->update(['status' => 'paid']);

        // Enviar notificación al cliente
        $client = $invoice->client;
        $client->notify(new PaymentReceived($invoice));

        return back()->with('success', 'Pago confirmado y notificación enviada al cliente.');
    }
}