@extends('layouts.plantilla')
    @section('contenido')

        <h1>Modification of a destination</h1>

        <div class="bg-light border-secondary col-8 mx-auto shadow rounded p-4">

        <form action="/modifyDestination" method="post">
        @csrf
            Name: <br>
            <input type="text" name="destName"
                   value="{{ $destination->destName }}"
                   class="form-control" required>
            <br>
            Region: <br>
            <select name="regID" class="form-control" required>
                <option value="{{ $destination->regID }}">{{ $destination->regName }}</option>
            @foreach( $regions as $region )
                <option value="{{ $region->regID }}">{{ $region->regName }}</option>
            @endforeach
            </select>
            <br>
            Price: <br>
            <input type="number" name="destPrice"
                   value="{{ $destination->destPrice }}"
                   class="form-control" required>
            <br>
            Total Seats: <br>
            <input type="number" name="destSeats"
                   value="{{ $destination->destSeats }}"
                   class="form-control" required>
            <br>
            Available Seats: <br>
            <input type="number" name="destAvailable"
                   value="{{ $destination->destAvailable }}"
                   class="form-control" required>
            <br>
            <input type="hidden" name="destID" value="{{ $destination->destID }}">
            <button class="btn btn-dark">Modify</button>
            <a href="/adminDestinations" class="btn btn-outline-secondary ml-3">
                 Back to panel
            </a>
        </form>

        </div>

    @endsection

