@extends('layouts.plantilla')

    @section('contenido')
        <h1>Delete a región</h1>

        <div class="bg-light col-6 mx-auto shadow rounded p-4 text-danger">
            The following region will be removed:
            <span class="lead">{{$region->regName}}</span>
            <form action="/deleteRegion" method="post">
                @csrf
                <input type="hidden" name="regID" value="{{$region->regID}}">
                <input type="hidden" name="regName" value="{{$region->regName}}">
                <button class="btn btn-danger btn-block mt-2">
                    Confirm
                </button>
                <a href="/adminRegions" class="btn btn-warning btn-block mt-2">
                    Back to panel
                </a>
            </form>
        </div>

        <script>
            Swal.fire(
                'Warning',
                'If you press "Confirm", the region will be deleted.',
                'warning'
            );
        </script>
    @endsection
