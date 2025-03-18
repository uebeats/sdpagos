@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Pago</h2>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('payments.update', $payment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Suscripción</label>
            <select name="subscription_id" class="form-control" required>
                @foreach ($subscriptions as $subscription)
                    <option value="{{ $subscription->id }}" {{ $subscription->id == $payment->subscription_id ? 'selected' : '' }}>
                        {{ $subscription->client->name }} - {{ $subscription->service->name }} - ${{ number_format($subscription->service->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Monto</label>
            <input type="number" name="amount" class="form-control" step="0.01" min="0" value="{{ $payment->amount }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Método de Pago</label>
            <select name="method" class="form-control" required>
                <option value="transfer" {{ $payment->method == 'transfer' ? 'selected' : '' }}>Transferencia</option>
                <option value="mercadopago" {{ $payment->method == 'mercadopago' ? 'selected' : '' }}>Mercado Pago</option>
                <option value="webpay" {{ $payment->method == 'webpay' ? 'selected' : '' }}>Webpay</option>
                <option value="paypal" {{ $payment->method == 'paypal' ? 'selected' : '' }}>PayPal</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">ID de Transacción</label>
            <input type="text" name="transaction_id" class="form-control" value="{{ $payment->transaction_id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="successful" {{ $payment->status == 'successful' ? 'selected' : '' }}>Exitoso</option>
                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Fallido</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Pago</label>
            <input type="datetime-local" name="paid_at" class="form-control" value="{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d\TH:i') : '' }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar Pago</button>
    </form>
</div>
@endsection
