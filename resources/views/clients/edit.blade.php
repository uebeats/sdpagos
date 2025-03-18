@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Editar Cliente</h2>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">RUT</label>
            <input type="text" name="rut" class="form-control" value="{{ $client->rut }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" value="{{ $client->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="address" class="form-control" value="{{ $client->address }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar Cliente</button>
    </form>
</div>
@endsection
