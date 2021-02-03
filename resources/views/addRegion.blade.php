@extends('layouts.layout')

    @section('content')

        <h1>Registration of a new region</h1>

        <div class="bg-light border-secondary col-8 mx-auto shadow rounded p-4">

            <form action="/addRegion" method="post">
            @csrf
                Region: <br>
                <input type="text" name="regName"
                       class="form-control">
                <br>
                <button class="btn btn-dark">Add</button>
                <a href="/adminRegions" class="btn btn-outline-secondary ml-3">
                    Back to panel
                </a>
            </form>

        </div>

    @endsection
