@extends('layouts.plantilla')
    @section('contenido')

        <h1>Registration of a new destination</h1>

        <div class="bg-light border-secondary col-8 mx-auto shadow rounded p-4">

        <form action="/addDestination" method="post">
        @csrf
            Name: <br>
            <input type="text" name="destName" class="form-control" required>
            <br>
            Region: <br>
            <select name="regID" class="form-control" required>
                <option value="">Select a Region</option>
            @foreach( $regions as $region )
                <option value="{{ $region->regID }}">{{ $region->regName }}</option>
            @endforeach
            </select>
            <br>
            Price: <br>
            <input type="number" name="destPrice" class="form-control" required>
            <br>
            Total Seats: <br>
            <input type="number" name="destSeats" class="form-control" required>
            <br>
            Available Seats: <br>
            <input type="number" name="destAvailable" class="form-control" required>
            <br>
            <button class="btn btn-dark">Add</button>
            <a href="/adminDestinations" class="btn btn-outline-secondary ml-3">
                 Back to panel
            </a>
        </form>

        </div>

    @endsection

