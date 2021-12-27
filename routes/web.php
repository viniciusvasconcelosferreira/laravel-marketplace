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

Route::get('/model', function () {
    //$products = \App\Models\Product::all(); //select * from products

    // Inserção chamada Active Record
    // $user = new \App\Models\User();
    //$user = \App\Models\User::find(1);
    //$user->name = 'Usuário Teste';
    //$user->email = 'email@teste.com';
    // $user->password = bcrypt('12345678');
    //$user->save();
    //return

    /*
     \App\Models\User::all() - retorna todos os usuários
     \App\Models\User::find(1) - retorna o usuário baseado no id
     \App\Models\User::where('name','Christelle Stiedemann') - retorna o usuário baseado no where (select * from users where name = 'Christelle Stiedemann')
    \App\Models\User::where('name','Christelle Stiedemann')->first() - retorna o primeiro usuário baseado no where
    \App\Models\User::paginate(10) - retorna todos os usuários com um limite de 10 por página
    */

    // Mass Assignment - Atribuição em massa

    $user = \App\Models\User::class;

//    $user::create([
//        'name' => 'Nanderson Castro',
//        'email' => 'email100@email.com',
//        'password' => bcrypt('12233445566')
//    ]);
//    dd($user); //var_dump + die

    // Mass Update
//    $user::find(12)->update([
//        'name' => 'Nanderson Castro de Souza'
//    ]);
//dd($user);
    return $user::all(); //Retorno de uma collection
});
