@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Agregar Suscripción</h2>

    <a href="{{ route('subscriptions.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('subscriptions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="client_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->rut }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Servicio</label>
            <select name="service_id" class="form-control" required>
                <option value="">Seleccione un servicio</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }} - ${{ number_format($service->price, 2) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Próxima Facturación</label>
            <input type="date" name="next_billing_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pendiente</option>
                <option value="paid">Pagado</option>
                <option value="overdue">Atrasado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Suscripción</button>
    </form>
</div>
@endsection
