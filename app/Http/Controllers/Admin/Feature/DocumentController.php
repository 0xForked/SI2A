<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

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
        $transaction = Transaction::with(['items' => function($query) {
            $query->with(['product' => function($query) {
                $query->with('unit');
            }]);
        }])->with('customer')->findOrFail($transaction_id);

        view()->share([
            'transaction' => $transaction,
        ]);
        if ($transaction->type == "PURCHASE")  {
            // $paper_size = array(0,0,360,360);
            $pdf = PDF::loadView('document.purchase')->setPaper('A4','portrait');;
            if ($request->has('download')) {
                return $pdf->download();
            }
            return $pdf->stream();
        }
        if ($transaction->type == "SELLING")  {
            $pdf = PDF::loadView('document.selling')->setPaper('A4','portrait');;
            if ($request->has('download')) {
                return $pdf->download();
            }
            return $pdf->stream();
        }
    }

}
