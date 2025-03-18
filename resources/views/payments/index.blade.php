@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pagos</h2>

    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">Registrar Pago</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Monto</th>
                <th>Método</th>
                <th>Estado</th>
                <th>Fecha de Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->subscription->client->name }}</td>
                    <td>{{ $payment->subscription->service->name }}</td>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                    <td>{{ ucfirst($payment->method) }}</td>
                    <td>
                        <span class="badge 
                            {{ $payment->status == 'pending' ? 'bg-warning' : 
                               ($payment->status == 'successful' ? 'bg-success' : 'bg-danger') }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>{{ $payment->paid_at ? $payment->paid_at->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este pago?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $payments->links() }}
</div>
@endsection
