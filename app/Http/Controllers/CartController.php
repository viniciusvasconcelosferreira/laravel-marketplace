<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $productData = $request->get('product');

        //buscando no produto
        $product = Product::whereSlug($productData['slug']);

        if (!$product->count() || $productData['amount'] == 0)
            return redirect()->route('home');

        //fazendo o merge para corrigir caso tenha sido modificado
        $product = array_merge($productData, $product->first(['name', 'price', 'store_id'])->toArray());

        //verificar se existe sessao para os produtos
        if (session()->has('cart')) {
            //pegar os itens na sessao
            $products = session()->get('cart');
            //armazenar os slug dos itens da sessao
            $productsSlugs = array_column($products, 'slug');
            //verificar se os slug estão no array
            if (in_array($product['slug'], $productsSlugs)) {
                //fazer o incremento para evitar a duplicidade
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                //sobreescrever a sessao
                session()->put('cart', $products);
            } else {
                //existindo eu adiciono este produto na sessao existente
                session()->push('cart', $product);
            }
        } else {
            //nao existindo eu crio a sessao com o primeiro produto
            $products[] = $product;

            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho.')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');
        flash('Desistência da compra realizada com sucesso.')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
//        Aplica uma função em todos os elementos dos arrays dados
        $products = array_map(function ($line) use ($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}
