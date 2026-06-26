<?php

use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
//* Inicio de sesion para alumnos

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/pruebas', function(){
    $usuario = Auth::user()->username;
    $grupo_id = DB::table('alumnos_grupos')->where('id_pwc', $usuario)->value('grupo_id');
    $plantel_id = DB::table('alumnos')->where('id_pwc', $usuario)->value('plantel_id');

    $coordinadores = DB::table('mentores_coordinadores')->where('plantel_id', $plantel_id)->where('grupo_id', $grupo_id)->where('isCoordinador', 1)->get();
    //* Si coordinadores por grupo falla almacenara un array vacio.
    if($coordinadores->isEmpty()){
        //*Si Coordinadores viene vacio realizamos una consulta para sacar el mentor general del plantel este mentor puede o no existir.
        $coordinadores=DB::table('mentores_coordinadores')->where('plantel_id', $plantel_id)->where('grupo_id', '999999')->where('isCoordinador', 1)->get();
    }
    //*Si no existe Coordinador general ni coordinador asignado por grupo entonces pasamos coordinadores vacio y lo tratamos en el frente.
    $mentores = DB::table('mentores_coordinadores')->where('plantel_id', $plantel_id)->where('grupo_id', $grupo_id)->where('isMentor', 1)->get();
    return view('pruebas', compact('coordinadores', 'mentores'));
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\PrincipalController@Index')->name('dashboard');
Route::group(['middleware' => ['auth']], function () {
Route::resources([
        'principal' => 'App\Http\Controllers\PrincipalController'
    ]);

});



/*
 //* Cierre de periodo de evaluacion docente

Route::redirect('/login', '/');
Route::get('/',function(){
   return view('cierre');
});
*/

/*
* Una vez agregada la informacion a la base de datos procesada como corresponde se bebera descomentar la linea 33 correspondiente al proceso para generar los usuarios.
*/

//Route::get('/proceso', 'App\Http\Controllers\PrincipalController@CrearUsuarios')->name('proceso');

/*
    ? Deberia de eliminar estos metodos ya que son muy lentos o en su consecuente mejorarlos o automatizarlos en excel
    ! Metodos lentos para llenado de información.
*/
//Route::get('/agregarID', 'App\Http\Controllers\PrincipalController@AgregarIds')->name('AgregarIds');
//Route::get('/agregarIDgrupos', 'App\Http\Controllers\PrincipalController@AgregarIdsGrupos')->name('AgregarIdsGrupos');


/*
    *Al momento de iniciar el pediodo de evaluacion  descomentar la linea 42 para poder generar los reportes correspondientes.
    *Las lineas 43 y 44 solo se utilizaran en el periodo de evaluacion a plantel usualmente a final de año en el periodo 3C.
*/
//Route::get('/reportes/{id}','App\Http\Controllers\PrincipalController@reportes')->name('reporte');
//Route::get('/nps/{id}','App\Http\Controllers\PrincipalController@nps')->name('nps');
//Route::post('/nps/','App\Http\Controllers\PrincipalController@npsStore')->name('npsStore');


//*Si la ruta no coincide con nada de lo de arriba, mándalo al inicio
Route::fallback(function () {
    return redirect('/');
});
