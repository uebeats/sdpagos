@extends('layouts.auth')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h2 class="text-center">Consulta de Pagos Pendientes</h2>
                <div class="card mt-4">
                    <div class="card-body">
                        <form id="paymentForm">
                            <div class="mb-3">
                                <label for="rut" class="form-label">Ingrese su RUT:</label>
                                <input type="text" id="rut" name="rut" class="form-control" required placeholder="12345678-9" value="{{ old('rut') }}">
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

        $(document).ready(function() {
            $('#paymentForm').submit(function(event) {
                event.preventDefault();

                // Quitar puntos del RUT
                let rut = $('#rut').val();
                rut = rut.replace(/\./g, '');
                console.log(rut); 

                $.ajax({
                    url: "{{ route('pending.payments') }}",
                    type: "POST",
                    data: {
                        rut: rut,
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {
                        $('#paymentResults').html(
                            '<p class="text-center">Buscando pagos pendientes...</p>');
                    },
                    success: function(response) {
                        if (response.payments.length === 0) {
                            $('#paymentResults').html(
                                '<p class="text-success text-center">No hay pagos pendientes.</p>'
                            );
                        } else {
                            let html = `
                            <h4 class="mt-3">Pagos Pendientes</h4>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Monto</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                            response.payments.forEach(payment => {
                                html += `
                                <tr>
                                    <td>${payment.subscription.service.name}</td>
                                    <td>$${payment.amount}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm pay-btn" data-id="${payment.id}">Pagar</button>
                                    </td>
                                </tr>`;
                            });

                            html += `</tbody></table>`;
                            $('#paymentResults').html(html);
                        }
                    },
                    error: function(xhr) {
                        $('#paymentResults').html(
                            '<p class="text-danger text-center">No se encontraron pagos pendientes.</p>'
                        );
                    }
                });
            });

            $(document).on('click', '.pay-btn', function() {
                alert('Aquí se implementaría la lógica de pago para el ID: ' + $(this).data('id'));
            });
        });
    </script>
@endpush
