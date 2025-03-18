@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Servicio</h2>

    <a href="{{ route('services.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('services.update', $service) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del Servicio</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ $service->price }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ciclo de Facturación</label>
            <select name="billing_cycle" class="form-control" required>
                <option value="monthly" {{ $service->billing_cycle == 'monthly' ? 'selected' : '' }}>Mensual</option>
                <option value="quarterly" {{ $service->billing_cycle == 'quarterly' ? 'selected' : '' }}>Trimestral</option>
                <option value="semi-annually" {{ $service->billing_cycle == 'semi-annually' ? 'selected' : '' }}>Semestral</option>
                <option value="annually" {{ $service->billing_cycle == 'annually' ? 'selected' : '' }}>Anual</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Servicio</button>
    </form>
</div>
@endsection
