@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Agregar Servicio</h2>

    <a href="{{ route('services.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre del Servicio</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ciclo de Facturación</label>
            <select name="billing_cycle" class="form-control" required>
                <option value="monthly">Mensual</option>
                <option value="quarterly">Trimestral</option>
                <option value="semi-annually">Semestral</option>
                <option value="annually">Anual</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar Servicio</button>
    </form>
</div>
@endsection
