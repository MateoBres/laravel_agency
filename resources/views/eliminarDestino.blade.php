@extends('layouts.plantilla')

    @section('contenido')
        <h1>Delete a destination</h1>

        <div class="bg-light col-6 mx-auto shadow rounded p-4 text-danger">
            The following destination will be deleted:
            <span class="lead">{{$destino->destNombre}}</span>
            <form action="/eliminarDestino" method="post">
                @csrf
                <input type="hidden" name="destID" value="{{$destino->destID}}">
                <input type="hidden" name="destNombre" value="{{$destino->destNombre}}">
                <button class="btn btn-danger btn-block mt-2">
                    Confirm
                </button>
                <a href="/adminDestinos" class="btn btn-warning btn-block mt-2">
                    Back to panel
                </a>
            </form>
        </div>

        <script>
            Swal.fire(
                'Warning',
                'If you press "Confirm", the destination will be deleted.',
                'warning'
            );
        </script>
    @endsection
