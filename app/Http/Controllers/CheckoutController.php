<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
//        session()->forget('pagseguro_session_code');
        if (auth()->check()) {
            return redirect()->route('login');
        }

        $this->makePagSeguroSession();

        return view('checkout');
    }

    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
//        dd($sessionCode);
            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
