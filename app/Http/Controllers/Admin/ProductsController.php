<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\UploadTrait;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    use UploadTrait;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // armazena na variavel products a loja(objeto) do usuário
        // autenticado que faz acesso aos produtos via metodo para
        // poder gerar o paginate
        $products = auth()->user()->store->products()->paginate(10);

//        dd($products);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);

//        $stores = auth()->user()->store->name;
//        dd($stores);


        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all();

        $store = auth()->user()->store;

        $product = $store->products()->create($data);

        $product->categories()->sync($data['categories']);

        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            //insercao das referencias das imagens na base
            $product->photos()->createMany($images);
        }

        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->findOrFail($product);
        $categories = Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();

        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');
            //insercao das referencias das imagens na base
            $product->photos()->createMany($images);
        }

        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {

        $product = $this->product->find($product);
        $product->delete();

        flash('Produto removido com sucesso!')->success();

        return redirect()->route('admin.products.index');
    }
}
