@extends('layouts.layout')
@section('content')
    <h1>Destination management panel</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-borderless table-striped table-hover">
        <thead>
        <tr>
            <th>Destination (airport)</th>
            <th>Region</th>
            <th>Price</th>
            <th colspan="2">
                <a href="/addDestination" class="btn btn-outline-secondary">
                    Add
                </a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $destinations as $destination )
            <tr>
                <td>{{ $destination->destName }}</td>
                <td>{{ $destination->regName }}</td>
                <td>${{ $destination->destPrice }}</td>
                <td>
                    <a href="/modifyDestination/{{ $destination->destID }}" class="btn btn-outline-secondary">
                        Modify
                    </a>
                </td>
                <td>
                    <a href="/deleteDestination/{{ $destination->destID }}" class="btn btn-outline-secondary">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
