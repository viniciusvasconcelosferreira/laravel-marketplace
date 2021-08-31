<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    /*
    Maneiras de enviar parametros para view:
    - Parametro:
        - $helloWorld = 'Hello World';
    - Envio:
        - Array
            - Ex.: return view('welcome',['helloWordl'=>$helloWorld]);
        - Compact
            - Ex.: return view('welcome',compact('helloWorld'));


    */
    return view('welcome');
});
