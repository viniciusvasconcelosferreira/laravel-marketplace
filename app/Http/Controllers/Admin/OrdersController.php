<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $order;

    public function __construct(UserOrder $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        //busca dos pedidos das lojas do utilizador
        $orders = auth()->user()->store ? auth()->user()->store->orders()->paginate(15) : auth()->user()->store;

        return view('admin.orders.index', compact('orders'));
    }
}
