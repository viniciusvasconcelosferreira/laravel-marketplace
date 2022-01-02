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

//Route::get
//Route::post
//Route::put
//Route::patch
//Route::delete
//Route::options

//Route::get('/admin/stores', 'App\Http\Controllers\Admin\StoreController@index');
//Route::get('/stores', [\App\Http\Controllers\Admin\StoreController::class, 'index']);

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
Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'CartController@index')->name('index');
        Route::post('add', 'CartController@add')->name('add');
        Route::get('remove/{slug}', 'CartController@remove')->name('remove');
        Route::get('cancel', 'CartController@cancel')->name('cancel');
    });
});
//name -> Apelido

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
    $store = \App\Models\Store::class;
    $category = \App\Models\Category::class;
    $product = \App\Models\Product::class;

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

    //Como pegar a loja de um usuário
    //return dd($user::find(4)->store()->count()); // O objeto único (Store) e se for Collection de Dados (Objetos)
//    return $store::find(1)->products()->where('id',1)->get();
//    return $store::find(1)->products;

    //Pegar as categorias de uma loja
//    $category->products;

    //Criar uma loja para um usuário
//    $user::find(10)->store()->create([
//        'name' => 'Loja Teste',
//        'description' => 'Loja teste de produtos de informática',
//        'mobile_phone' => 'XX-XXXXX-XXXX',
//        'phone' => 'XX-XXXXX-XXXX',
//        'slug' => 'loja-teste'
//    ]);

    //Criar um produto para uma loja
//    $store = $store::find(41);
//    $store->products()->create([
//        'name' => 'Notebook Dell',
//        'description' => 'CORE I5 10GB',
//        'body' => 'Qualquer coisa...',
//        'price' => 2999.90,
//        'slug' => 'notebook-dell',
//    ]);
//    dd($store);

    //Criar uma categoria
//    $category = $category::create(
//        [
//            'name' => 'Games',
//            'description' => null,
//            'slug' => 'games'
//        ],
//        [
//            'name' => 'Notebooks',
//            'description' => null,
//            'slug' => 'notebooks'
//        ]
//    );

    //Adicionar um produto para uma categoria ou vice-versa
//    $product = $product::find(49);
//    dd($product->categories()->sync([1,2])); // attach adicionar e detach remover (retorna a quantidade de itens removidos)

    return $category::all(); //Retorno de uma collection
});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->name('admin.')->namespace('App\Http\Controllers\Admin')->group(function () {

//    Route::prefix('stores')->name('stores.')->group(function () {
//        Route::get('/', 'StoreController@index')->name('index');
//        Route::get('/create', 'StoreController@create')->name('create');
//        Route::post('/store', 'StoreController@store')->name('store');
//        Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
//        Route::post('/update/{store}', 'StoreController@update')->name('update');
//        Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
//    });

        Route::resource('stores', 'StoreController');

        Route::resource('products', 'ProductsController');

        Route::resource('categories', 'CategoryController');
//name() = apelido
        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
