@extends('layouts.layout')

    @section('content')
        <h1>Regions management panel</h1>

        @if(session('message'))

            <div class="alert alert-success p-2">
                {{session('message')}}
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
            @foreach($regions as $region)
                <tr>
                    <td>{{$region->regID}}</td>
                    <td>{{$region->regName}}</td>
                    <td>
                        <a href="/modifyRegion/{{$region->regID}}" class="btn btn-outline-secondary">
                            Modify
                        </a>
                    </td>
                    <td>
                        <a href="deleteRegion/{{$region->regID}}" class="btn btn-outline-secondary">
                            Delete
                        </a>
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>
    @endsection

