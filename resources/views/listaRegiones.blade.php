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
        <h1>List of regions</h1>

        @foreach($regiones as $region)
        <div class="list-group col-4">
            <span class="list-group-item list-group-item-action">
                {{$region->regID}} - {{$region->regNombre
}}
            </span>
        </div>
        @endforeach
    </main>

</body>
</html>
