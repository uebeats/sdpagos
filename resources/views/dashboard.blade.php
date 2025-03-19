@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card bg-primary text-primary-fg">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="fw-normal">Clientes</h3>
                            <h6 class="display-6 fw-bold">
                                {{ $totalClients }}
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card bg-lime text-primary-fg">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-lime">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-heart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14.872 11.13a3.001 3.001 0 1 0 -4.29 3.514" />
                                    <path d="M10 18h-5a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v3" />
                                    <path d="M6 12h.01" />
                                    <path
                                        d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.24 2.24 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.24 2.24 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="fw-normal">Pagos completados</h3>
                            <h6 class="display-6 fw-bold">
                                {{ $totalPaidInvoices }}
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card bg-orange text-primary-fg">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-orange">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote-off">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405" />
                                    <path
                                        d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1" />
                                    <path d="M18 12l.01 0" />
                                    <path d="M6 12l.01 0" />
                                    <path d="M3 3l18 18" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="fw-normal">Pagos pendientes</h3>
                            <h6 class="display-6 fw-bold">
                                {{ $totalPendingInvoices }}
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card bg-indigo text-primary-fg">
                        <div class="card-stamp card-stamp-lg">
                            <div class="card-stamp-icon bg-indigo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-dollar">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                    <path
                                        d="M14.8 8a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                                    <path d="M12 6v10" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="fw-normal">Recaudado</h3>
                            <h6 class="display-6 fw-bold">
                                ${{ number_format($totalPayments, 0, ',', '.') }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
