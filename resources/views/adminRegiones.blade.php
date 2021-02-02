@extends('layouts.plantilla')

    @section('contenido')
        <h1>Regions management panel</h1>

        @if(session('mensaje'))

            <div class="alert alert-success p-2">
                {{session('mensaje')}}
            </div>

        @endif

        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Region</th>
                    <th colspan="2">
                        <a href="/agragarRegion" class="btn btn-outline-secondary">
                            Add
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach($regiones as $region)
                <tr>
                    <td>{{$region->regID}}</td>
                    <td>{{$region->regNombre}}</td>
                    <td>
                        <a href="/modificarRegion/{{$region->regID}}" class="btn btn-outline-secondary">
                            Modify
                        </a>
                    </td>
                    <td>
                        <a href="eliminarRegion/{{$region->regID}}" class="btn btn-outline-secondary">
                            Delete
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>
    @endsection

