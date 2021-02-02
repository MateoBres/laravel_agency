@extends('layouts.plantilla')
@section('contenido')
    <h1>Destination management panel</h1>

    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <table class="table table-borderless table-striped table-hover">
        <thead>
        <tr>
            <th>Destination (airport)</th>
            <th>Region</th>
            <th>Price</th>
            <th colspan="2">
                <a href="/agregarDestino" class="btn btn-outline-secondary">
                    Add
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $destinos as $destino )
            <tr>
                <td>{{ $destino->destNombre }}</td>
                <td>{{ $destino->regNombre }}</td>
                <td>${{ $destino->destPrecio }}</td>
                <td>
                    <a href="/modificarDestino/{{ $destino->destID }}" class="btn btn-outline-secondary">
                        Modify
                    </a>
                </td>
                <td>
                    <a href="/eliminarDestino/{{ $destino->destID }}" class="btn btn-outline-secondary">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
