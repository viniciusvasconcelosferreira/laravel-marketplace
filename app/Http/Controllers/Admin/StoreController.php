<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        //paginate; simplePaginate; cursorPaginate
        $stores = Store::paginate(10);

//        dd($stores);

        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $users = User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = auth()->user();

        $store = $user->store()->create($data);

        flash('Loja Criada com Sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, $store)
    {
        $data = $request->all();

        $store = Store::find($store);
        $store->update($data);

        flash('Loja Atualizada com Sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = Store::find($store);
        $store->delete();
        flash('Loja Removida com Sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
