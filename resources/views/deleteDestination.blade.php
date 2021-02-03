@extends('layouts.layout')

    @section('content')
        <h1>Delete a destination</h1>

        <div class="bg-light col-6 mx-auto shadow rounded p-4 text-danger">
            The following destination will be deleted:
            <span class="lead">{{$destination->destName}}</span>
            <form action="/deleteDestination" method="post">
                @csrf
                <input type="hidden" name="destID" value="{{$destination->destID}}">
                <input type="hidden" name="destName" value="{{$destination->destName}}">
                <button class="btn btn-danger btn-block mt-2">
                    Confirm
                </button>
                <a href="/adminDestinations" class="btn btn-warning btn-block mt-2">
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
