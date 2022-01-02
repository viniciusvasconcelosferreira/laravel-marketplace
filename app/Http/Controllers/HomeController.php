<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->limit(9)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('products'));
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
