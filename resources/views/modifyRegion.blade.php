@extends('layouts.plantilla')

    @section('contenido')

        <h1>Modification of a region</h1>

        <div class="bg-light border-secondary col-8 mx-auto shadow rounded p-4">

            <form action="/modifyRegion" method="post">
            @csrf
                Region: <br>
                <input type="text" name="regName"
                       class="form-control"
                       value="{{ $region->regName }}">
                <input type="hidden" name="regID"
                       value="{{ $region->regID  }}">
                <br>
                <button class="btn btn-dark">Modify</button>
                <a href="/adminRegions" class="btn btn-outline-secondary ml-3">
                    Back to panel
                </a>
            </form>

        </div>

    @endsection
