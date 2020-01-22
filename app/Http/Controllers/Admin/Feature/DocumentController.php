<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $transaction_id)
    {
        $transaction = Transaction::with('items')->findOrFail($transaction_id);
        if ($transaction->type == "PURCHASE")  return view('document.purchase', compact('transaction'));
        if ($transaction->type == "SELLING")  return view('document.selling', compact('transaction'));
    }

}
