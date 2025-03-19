@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Clientes</h2>

        <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Agregar Cliente</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="px-4 py-4">
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <label for="brand-filter" class="form-label">Filtrar por Marca:</label>
                        <select id="brand-filter" name="brand_id" class="form-select">
                            <option value="0">Todas</option>
                            <option value="1">Chalo</option>
                            <option value="2">KeepCup</option>
                            <option value="3">Melitta</option>
                            <option value="4">Café Soca</option>
                            <option value="5">Bio-Lip</option>
                            <!-- Añade más categorías según sea necesario -->
                        </select>
                    </div>

                    <div class="col-12 col-lg-2">
                        <!-- Filtro por Estado -->
                        <div class="">
                            <label for="status-filter" class="form-label">Filtrar por Estado:</label>
                            <select id="status-filter" name="status" class="form-select">
                                <option value="0">Todos</option>
                                <option value="publish">Publicado</option>
                                <option value="draft">Archivado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-2">
                        <!-- Filtro por Stock -->
                        <div class="">
                            <label for="stock-filter" class="form-label">Filtrar por Stock:</label>
                            <select id="stock-filter" name="stock" class="form-select">
                                <option value="0">Todos</option>
                                <option value="with_stock">Con stock</option>
                                <option value="without_stock">Bajo stock</option>
                                <option value="zero_stock">Sin stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-2">
                        <!-- Filtro por Busqueda -->
                        <div class="">
                            <label for="search" class="form-label">Búsqueda:</label>
                            <input type="text" id="search" name="search" class="form-control"
                                placeholder="Buscar por Nombre o SKU">
                        </div>
                    </div>

                    <div class="col-12 col-lg-2">
                        <!-- Boton para filtrar -->
                        <div class="">
                            <label for="filter" class="form-label">&nbsp;</label>
                            <button id="filter" class="btn btn-orange w-100" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-horizontal">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M4 6l8 0"></path>
                                    <path d="M16 6l4 0"></path>
                                    <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M4 12l2 0"></path>
                                    <path d="M10 12l10 0"></path>
                                    <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M4 18l11 0"></path>
                                    <path d="M19 18l1 0"></path>
                                </svg>
                                Filtrar
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-lg-2">
                        <div>
                            <label for="search" class="form-label">&nbsp;</label>
                            <button class="btn btn-lime w-100" onclick="exportPdf()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-arrow-right">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                    <path d="M9 15h6"></path>
                                    <path d="M12.5 17.5l2.5 -2.5l-2.5 -2.5"></path>
                                </svg>
                                Exportar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>RUT</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->rut }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar este cliente?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{ $clients->links() }}
    </div>
@endsection
