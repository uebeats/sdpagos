@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Suscripciones</h2>

    <a href="{{ route('subscriptions.create') }}" class="btn btn-primary mb-3">Agregar Suscripción</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Inicio</th>
                <th>Próximo Pago</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->client->name }}</td>
                    <td>{{ $subscription->service->name }}</td>
                    <td>{{ $subscription->start_date }}</td>
                    <td>{{ $subscription->next_billing_date }}</td>
                    <td>
                        <span class="badge 
                            {{ $subscription->status == 'pending' ? 'bg-warning' : 
                               ($subscription->status == 'paid' ? 'bg-success' : 'bg-danger') }}">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('subscriptions.edit', $subscription) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta suscripción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $subscriptions->links() }}
</div>
@endsection
