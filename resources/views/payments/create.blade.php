@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Registrar Pago</h2>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Suscripción</label>
            <select name="subscription_id" class="form-control" required>
                <option value="">Seleccione una suscripción</option>
                @foreach ($subscriptions as $subscription)
                    <option value="{{ $subscription->id }}">
                        {{ $subscription->client->name }} - {{ $subscription->service->name }} - ${{ number_format($subscription->service->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Monto</label>
            <input type="number" name="amount" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Método de Pago</label>
            <select name="method" class="form-control" required>
                <option value="transfer">Transferencia</option>
                <option value="mercadopago">Mercado Pago</option>
                <option value="webpay">Webpay</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">ID de Transacción (Opcional)</label>
            <input type="text" name="transaction_id" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pendiente</option>
                <option value="successful">Exitoso</option>
                <option value="failed">Fallido</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Pago (Opcional)</label>
            <input type="datetime-local" name="paid_at" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Registrar Pago</button>
    </form>
</div>
@endsection
