<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product, Store $store)
    {
        $this->product = $product;
        $this->store = $store;
    }

    public function index()
    {
        $products = $this->product->limit(6)->orderBy('id', 'DESC')->get();

        $stores = $this->store->limit(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('products', 'stores'));
    }

    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}

/*
 Middlewares: Dentro de aplicações web, ele é um código ou programa que é
 executado entre a requisição(Request) e a nossa aplicação(é a logica
 executada pelo acesso a uma determinada rota)

Request -> Aplicação (Acesso qualquer) <- Marketplace
*/
