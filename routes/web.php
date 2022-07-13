<?php

use App\Http\Controllers\consultaData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ValidationKeyController;
use App\Http\Controllers\testController;
use App\Http\Controllers\saveEncuesta;
use App\Http\Controllers\encuestas;
use App\Http\Controllers\genpdf;
use App\Http\Controllers\genExcel;
use Illuminate\Support\Facades\Auth;


/*
    VISTAS PARA EL USUARIO
*/

    // PANTALLA PRINCIPAL Y VALIDACIÓN DE CONTRASEÑA

    Route::view('/', 'userClave')->name('clave');

    Route::get('validationKey', [ValidationKeyController::class, 'index'])->name('getClave');

    // VISTA DE DATOS PERSONALES Y GUARDADO DE INFROMACIÓN PARA LOS DATOS PERSONALES
    Route::get('/datosPersonales/{clave}', [testController::class, 'index'], function(){
        return view('test.idereOne');
    })->name('datosPersonales');

    Route::put('/saveDatos/{id}', [testController::class, 'update'])->name('test.update');

    // VISTA DE LA ENCUESTA Y GUARDADO DE INFROMACIÓN PARA LA ENCUESTA

    Route::get('/encuesta/{clave}', [saveEncuesta::class, 'index'], function(){
        return view('test.idereTwo');
    })->name('encuesta');

    Route::post('saveEncuesta', [saveEncuesta::class, 'store'])->name('test.store');

/*
    TERMINACIÓN DE VISTAS PARA EL USUARIO
*/

/* 
    VISTAS PARA EL ADMINISTRADOR
*/
    // VISTAS Y RUTAS PRINICIPALES PARA LA PROGRMACIÓN DE ENCUESTAS
    Route::get('/programarEncuesta', [encuestas::class, 'index'], function(){
        return view('admin.pencuesta');
    })->name('pencuesta');

    Route::get('/agregarEncuesta', [encuestas::class, 'create'], function(){
        return view('admin.test.agregart');
    })->name('pencuesta.create');

    Route::get('/editarEncuesta/{id}', [encuestas::class, 'show'])->middleware('auth')->name('pencuesta.show');

    Route::get('/genPDF/{id}', [genpdf::class, 'index'])->middleware('auth')->name('pencuesta.genpdf');

    Route::post('savetest', [encuestas::class, 'store'])->middleware('auth')->name('pencuesta.store');

    Route::delete('deletTest/{id}', [encuestas::class, 'destroy'])->middleware('auth')->name('pencuesta.destroy');

    Route::put('updatetest/{id}', [encuestas::class, 'update'])->middleware('auth')->name('pencuesta.update');

//Route::view('/programarEncuesta', 'admin.pencuesta')->name('pencuesta');
    

    // VISTAS Y RUTAS NECESARIAS PARA LA CONSULTA DE ENCUESTAS
    Route::get('/consultas', [consultaData::class, 'index'], function(){
        return view('admin.consulta');
    })->name('consultas');

    Route::get('/mostrarResultados', [consultaData::class, 'show'])->name('consultas.show');

    Route::get('/mostrarResultadosGenerales', [consultaData::class, 'showGeneral'])->name('consultas.showGeneral');

    Route::get('/genExcel', [genExcel::class, 'genExcelD'])->name('consultas.excel');

    //Route::view('/consultas', 'admin.consulta')->middleware('auth')->name('consultas');

/*
    TERMINACIÓN DE VISTAS PARA EL ADMINISTRADOR
*/

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Auth::routes();
