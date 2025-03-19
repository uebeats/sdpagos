@extends('layouts.auth')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <h2 class="text-center">Consulta de Pagos Pendientes</h2>
                <div class="card mt-4">
                    <div class="card-body">
                        <form id="paymentForm">
                            <div class="mb-3">
                                <label for="rut" class="form-label">Ingrese su RUT:</label>
                                <input type="text" id="rut" name="rut" class="form-control" required placeholder="12345678-9" value="12345678-9">
                                @error('rut')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Consultar</button>
                        </form>
                    </div>
                </div>

                <div id="paymentResults" class="mt-4"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/jquery.rut-1.1.2/jquery.rut.min.js') }}"></script>
    <script>
        $('input[name="rut"]').rut({
            formatOn: 'keyup',
            minimumLength: 8, // validar largo mínimo; default: 2
            validateOn: 'blur' // si no se quiere validar, pasar null
        });
    </script>
@endpush
