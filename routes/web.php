<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#################################################
#####    CRUD DE REGIONES

// LISTING REGIONS
Route::get('/adminRegiones', function(){
    // RAW SQL
//    $regiones = DB::select(
//                    "SELECT regID, regNombre FROM regiones"
//                );
    $regiones = DB::table('regiones')->get();
    return view('adminRegiones',
                ['regiones' => $regiones]
        );
});

Route::post('/agregarRegion', function(){
    //CAPTURE THE DATA FROM THE FORM
    $regNombre = $_POST['regNombre'];
    // RAW SQL
//    DB::insert(
//        "INSERT INTO regiones(regNombre) VALUE (:regNombre)",
//            [$regNombre]
//    );
    // QUERY BUILDER
      DB::table('regiones')->insert(['regNombre'=>$regNombre]);
      return redirect('adminRegiones')
            ->with('mensaje', 'Region: ' .$regNombre. ' added successfully.');
});

Route::get('/agragarRegion', function(){
    return view('agregarRegion');
});

Route::get('/modificarRegion/{regID}', function($regID){
    // RAW SQL
    // $region = DB::select('SELECT * FROM regiones WHERE regID = :regID', [$regID]);
    // QUERY BUILDER
    $region = DB::table('regiones')
                    ->where('regID', $regID)
                    ->first();
    return view('modificarRegion' , [ 'region'=>$region ]);
});

Route::post('/modificarRegion', function(){
    //CAPTURE THE DATA FROM THE FORM
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    // RAW SQL
//    DB::update( 'UPDATE regiones
//                    SET regNombre = ?
//                    WHERE regID = ?', [ $regNombre, $regID ] );
    // QUERY BUILDER
    DB::table('regiones')
          ->where('regID', $regID)
          ->update([
                  'regNombre'=>$regNombre
              ]);
        return redirect('adminRegiones')
                    ->with('mensaje', 'Region: '.$regNombre.
                        ' modificada correctamente.');
});

Route::get('eliminarRegion/{regID}/{param?}', function($regID, $param=null){
    $region = DB::table('regiones')
                    ->where('regID', $regID)
                    ->first();
    return view('eliminarRegion',
                [
                    'region'=>$region
                ]);
});

Route::post('/eliminarRegion', function(){
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    // EXISTS
     if(DB::table('destinos')->where('regID', $regID)->exists()){
          return redirect('/adminRegiones')
                     ->with(
                        [
                            'mensaje'=>'The region '.$regNombre.' cannot be removed because has a assigned destination.'
                        ]
                    );
    };

    DB::table('regiones')
            ->where('regID', '=',$regID)
            ->delete();
    return redirect('/adminRegiones')
                ->with(
                    [
                        'mensaje'=>'The region '.$regNombre.' was deleted successfully.'
                    ]
                );
});



#################################################
#####    CRUD DE DESTINOS

// LISTING DESTINATIONS

Route::get('/adminDestinos', function(){
//   ---- RAW SQL ------
//    $destinos = DB::select(
//        // TABLE RELATION
////        "SELECT
////            destID, destNombre,
////            d.regID, r.regNombre,
////            destPrecio
////        FROM
////            destinos d, regiones r
////        WHERE d.regID = r.regID"
//        // JOIN TECHNIQUE
//        "SELECT
//            destID, destNombre,
//            d.regID, r.regNombre,
//            destPrecio
//        FROM
//            destinos d
//        JOIN
//            regiones r
//        ON
//            d.regID = r.regID"
//    );
//   ---- QUERY BUILDER ------
    $destinos = DB::table('destinos as d')
                ->join('regiones as r', 'd.regID', '=', 'r.regID')
                ->get();
    return view('adminDestinos',
            ['destinos' => $destinos]
        );
});

Route::get('/agregarDestino', function(){
    // QUERY FOR SELECT INPUT
    $regiones = DB::table('regiones')->get();
    return view('agregarDestino',
            [ 'regiones'=>$regiones ]
        );
});

Route::post('/agregarDestino', function(){
    //CAPTURE THE DATA FROM THE FORM
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio= $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];

    //INSERT DATA IN DESTINATION TABLE
    DB::table('destinos')->insert(
                [
                    'destNombre'=>$destNombre,
                    'regID'=>$regID,
                    'destPrecio'=>$destPrecio,
                    'destAsientos'=>$destAsientos,
                    'destDisponibles'=>$destDisponibles
                ]
    );

    // REDIRECT Y MESSAGE
    return redirect('adminDestinos')->with(
                            [
                                'mensaje'=>'Destination: ' .$destNombre. ' added successfully'
                            ]
    );
});

Route::get('/modificarDestino/{destID}', function($destID){
    $destino = DB::table('destinos as d')
                    ->join('regiones as r', 'd.regID', '=', 'r.regID')
                    ->where('destID', $destID)
                    ->first();
    $regiones = DB::table('regiones')->get();
    return view('modificarDestino',
                        [
                            'destino'=>$destino,
                            'regiones'=>$regiones
                        ]);
});


Route::post('/modificarDestino', function(){
    // WE CAPTURE DATA FROM THE FORM
    $destID = $_POST['destID'];
    $destNombre = $_POST['destNombre'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    $regID = $_POST['regID'];

    DB::table('destinos')
        ->where('destID', $destID)
        ->update([
            'destNombre' => $destNombre,
            'destPrecio' => $destPrecio,
            'destAsientos' => $destAsientos,
            'destDisponibles' => $destDisponibles,
            'regID' => $regID
        ]);
    return redirect('adminDestinos')
        ->with('mensaje', 'Destino: '.$destNombre.
            ' modificado correctamente.');
});

Route::get('eliminarDestino/{destID}', function($destID){
    $destino = DB::table('destinos')
        ->where('destID', $destID)
        ->first();
    return view('eliminarDestino',
        [
            'destino'=>$destino
        ]);
});

Route::post('/eliminarDestino', function(){
    $destID = $_POST['destID'];
    $destNombre = $_POST['destNombre'];

    DB::table('destinos')
        ->where('destID', '=', $destID)
        ->delete();
    return redirect('/adminDestinos')
        ->with(
            [
                'mensaje'=>'The destination '.$destNombre.' was deleted successfully.'
            ]
        );
});
