@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modification of a region</h1>

        <div class="bg-light border-secondary col-8 mx-auto shadow rounded p-4">

            <form action="/modificarRegion" method="post">
            @csrf
                Region: <br>
                <input type="text" name="regNombre"
                       class="form-control"
                       value="{{ $region->regNombre }}">
                <input type="hidden" name="regID"
                       value="{{ $region->regID  }}">
                <br>
                <button class="btn btn-dark">Modificar</button>
                <a href="/adminRegiones" class="btn btn-outline-secondary ml-3">
                    Back to panel
                </a>
            </form>

        </div>

    @endsection
