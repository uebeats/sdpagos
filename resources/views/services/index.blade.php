@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Servicios</h2>

    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Agregar Servicio</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Ciclo de Facturación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>${{ number_format($service->price, 2) }}</td>
                    <td>{{ ucfirst($service->billing_cycle) }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este servicio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $services->links() }}
</div>
@endsection
