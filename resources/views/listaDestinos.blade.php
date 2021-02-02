<!doctype html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <h1>List of destinations</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Id Region</th>
                    <th>Price</th>
                    <th>Seats</th>
                    <th>Available</th>
                </tr>
            </thead>
            <tbody>
        @foreach($destinos as $destino)
            <tr>
                <td>{{$destino->destID}}</td>
                <td>{{$destino->destNombre}}</td>
                <td>{{$destino->regNombre}}</td>
                <td>{{$destino->destPrecio}}</td>
                <td>{{$destino->destAsientos}} </td>
                <td>{{$destino->destDisponibles}}</td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
