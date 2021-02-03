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
#####    CRUD OF REGIONS

// LISTING REGIONS
Route::get('/adminRegions', function(){
    // RAW SQL
//    $regions = DB::select(
//                    "SELECT regID, regName FROM regions"
//                );
    $regions = DB::table('regions')->get();
    return view('adminRegions',
                ['regions' => $regions]
        );
});

Route::post('/addRegion', function(){
    //CAPTURE THE DATA FROM THE FORM
    $regName = $_POST['regName'];
    // RAW SQL
//    DB::insert(
//        "INSERT INTO regions(regName) VALUE (:regName)",
//            [$regName]
//    );
    // QUERY BUILDER
      DB::table('regions')->insert(['regName'=>$regName]);
      return redirect('adminRegions')
            ->with('mensaje', 'Region: ' .$regName. ' added successfully.');
});

Route::get('/agragarRegion', function(){
    return view('addRegion');
});

Route::get('/modifyRegion/{regID}', function($regID){
    // RAW SQL
    // $region = DB::select('SELECT * FROM regions WHERE regID = :regID', [$regID]);
    // QUERY BUILDER
    $region = DB::table('regions')
                    ->where('regID', $regID)
                    ->first();
    return view('modifyRegion' , [ 'region'=>$region ]);
});

Route::post('/modifyRegion', function(){
    //CAPTURE THE DATA FROM THE FORM
    $regID = $_POST['regID'];
    $regName = $_POST['regName'];
    // RAW SQL
//    DB::update( 'UPDATE regions
//                    SET regName = ?
//                    WHERE regID = ?', [ $regName, $regID ] );
    // QUERY BUILDER
    DB::table('regions')
          ->where('regID', $regID)
          ->update([
                  'regName'=>$regName
              ]);
        return redirect('adminRegions')
                    ->with('mensaje', 'Region: '.$regName.
                        ' modified successfully.');
});

Route::get('deleteRegion/{regID}/{param?}', function($regID, $param=null){
    $region = DB::table('regions')
                    ->where('regID', $regID)
                    ->first();
    return view('deleteRegion',
                [
                    'region'=>$region
                ]
        );
});

Route::post('/deleteRegion', function(){
    $regID = $_POST['regID'];
    $regName = $_POST['regName'];
    // EXISTS
     if(DB::table('destinations')->where('regID', $regID)->exists()){
          return redirect('/adminRegions')
                     ->with(
                        [
                            'mensaje'=>'The region '.$regName.' cannot be removed because has a assigned destination.'
                        ]
                    );
    };

    DB::table('regions')
            ->where('regID', '=',$regID)
            ->delete();
    return redirect('/adminRegions')
                ->with(
                    [
                        'mensaje'=>'The region '.$regName.' was deleted successfully.'
                    ]
                );
});



#################################################
#####    CRUD OF DESTINATIONS

// LISTING DESTINATIONS

Route::get('/adminDestinations', function(){
//   ---- RAW SQL ------
//    $destinations = DB::select(
//        // TABLE RELATION
////        "SELECT
////            destID, destName,
////            d.regID, r.regName,
////            destPrice
////        FROM
////            destinations d, regions r
////        WHERE d.regID = r.regID"
//        // JOIN TECHNIQUE
//        "SELECT
//            destID, destName,
//            d.regID, r.regName,
//            destPrice
//        FROM
//            destinations d
//        JOIN
//            regions r
//        ON
//            d.regID = r.regID"
//    );
//   ---- QUERY BUILDER ------
    $destinations = DB::table('destinations as d')
                ->join('regions as r', 'd.regID', '=', 'r.regID')
                ->get();
    return view('adminDestinations',
            ['destinations' => $destinations]
        );
});

Route::get('/addDestination', function(){
    // QUERY FOR SELECT INPUT
    $regions = DB::table('regions')->get();
    return view('addDestination',
            [ 'regions'=>$regions ]
        );
});

Route::post('/addDestination', function(){
    //CAPTURE THE DATA FROM THE FORM
    $destName = $_POST['destName'];
    $regID = $_POST['regID'];
    $destPrice= $_POST['destPrice'];
    $destSeats = $_POST['destSeats'];
    $destAvailable = $_POST['destAvailable'];

    //INSERT DATA IN DESTINATION TABLE
    DB::table('destinations')->insert(
                [
                    'destName'=>$destName,
                    'regID'=>$regID,
                    'destPrice'=>$destPrice,
                    'destSeats'=>$destSeats,
                    'destAvailable'=>$destAvailable
                ]
    );

    // REDIRECT Y MESSAGE
    return redirect('adminDestinations')->with(
                            [
                                'mensaje'=>'Destination: ' .$destName. ' added successfully'
                            ]
    );
});

Route::get('/modifyDestination/{destID}', function($destID){
    $destination = DB::table('destinations as d')
                    ->join('regions as r', 'd.regID', '=', 'r.regID')
                    ->where('destID', $destID)
                    ->first();
    $regions = DB::table('regions')->get();
    return view('modifyDestination',
                        [
                            'destination'=>$destination,
                            'regions'=>$regions
                        ]);
});


Route::post('/modifyDestination', function(){
    // WE CAPTURE DATA FROM THE FORM
    $destID = $_POST['destID'];
    $destName = $_POST['destName'];
    $destPrice = $_POST['destPrice'];
    $destSeats = $_POST['destSeats'];
    $destAvailable = $_POST['destAvailable'];
    $regID = $_POST['regID'];

    DB::table('destinations')
        ->where('destID', $destID)
        ->update([
            'destName' => $destName,
            'destPrice' => $destPrice,
            'destSeats' => $destSeats,
            'destAvailable' => $destAvailable,
            'regID' => $regID
        ]);
    return redirect('adminDestinations')
        ->with('mensaje', 'Destination: '.$destName.
            ' modified successfully.');
});

Route::get('deleteDestination/{destID}', function($destID){
    $destination = DB::table('destinations')
        ->where('destID', $destID)
        ->first();
    return view('deleteDestination',
        [
            'destination'=>$destination
        ]);
});

Route::post('/deleteDestination', function(){
    $destID = $_POST['destID'];
    $destName = $_POST['destName'];

    DB::table('destinations')
        ->where('destID', '=', $destID)
        ->delete();
    return redirect('/adminDestinations')
        ->with(
            [
                'mensaje'=>'The destination '.$destName.' was deleted successfully.'
            ]
        );
});
