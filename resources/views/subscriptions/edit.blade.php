@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Suscripción</h2>

    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $subscription->client_id ? 'selected' : '' }}>
                        {{ $client->name }} ({{ $client->rut }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Servicio</label>
            <select name="service_id" class="form-control" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $service->id == $subscription->service_id ? 'selected' : '' }}>
                        {{ $service->name }} - ${{ number_format($service->price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" class="form-control" value="{{ $subscription->start_date }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Próxima Facturación</label>
            <input type="date" name="next_billing_date" class="form-control" value="{{ $subscription->next_billing_date }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                <option value="paid" {{ $subscription->status == 'paid' ? 'selected' : '' }}>Pagado</option>
                <option value="overdue" {{ $subscription->status == 'overdue' ? 'selected' : '' }}>Atrasado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Suscripción</button>
    </form>
</div>
@endsection
