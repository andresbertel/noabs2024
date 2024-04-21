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


Route::group(['middleware' => 'guest'], function () {

    Route::get('/',function (){
		
        return redirect()->route('login');
    });

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});


Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth','can:isAdmin']], function () {
    Route::get('registrarinstitucion', 'adminController@institucionForm')->name('registarinstitucion');
    Route::post('registrarinstitucion', 'adminController@registerIntitucion');
    Route::get('registergestor', 'adminController@gestorForm')->name('registergestor');
  //  Route::post('registergestor', 'adminController@registerGestor');
    Route::get('instituciones', 'adminController@verInstituciones')->name('instituciones');
    Route::post('actualizarinstitucion','adminController@actualizarInstitucion')->name('actualizarinstitucion');
    Route::get('gestores', 'adminController@verGestores')->name('gestores');
    Route::post('actualizargestor', 'adminController@actualizarGestor')->name('actualizarGestor');
    Route::get('andres', 'adminController@andresmetodo');
    
 
    
});


Route::group(['middleware' => ['auth','can:isGestor']], function () {
   Route::get('registernino','gestorController@registerNinoForm')->name('registarninos');
   Route::post('registernino','gestorController@registerNino');
   Route::post('cargar-usuarios','gestorController@registerNinosCsv')->name('cargar.usuarios');

    Route::get('ninos','gestorController@verNinos')->name('ninos');
    Route::post('actualizarnino','gestorController@actualizarNino')->name('actualizarNino');
    Route::post('respuestasnino/{idRes}','gestorController@verResultadosById')->name('respuestasNinoId');
    Route::get('resultados','gestorController@verResultados')->name('resultados');

    Route::get('informesresultados/{idRes}','informesController@verResultadosById')->name('informes');
    Route::get('informesInstitucion/{idInst}','informesController@InformePorInstitucion')->name('inforinst');
    Route::get('GenerarInformeView','informesController@InformesView')->name('GenerarInformeView');
    Route::get('descargar-csv','informesController@descargarcsv')->name('descargar.csv');
   
    

});

//Route::group(['middleware' => ['auth','can:isNino'] ], function () {
    Route::post('/enviardatos','ninoController@enviarRespuestas');
//});


