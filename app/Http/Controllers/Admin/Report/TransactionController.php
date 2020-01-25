<?php

namespace App\Http\Controllers\Admin\Report;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use PDF;

class TransactionController extends Controller
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
    public function index(
        Request $request,
        $type,
        $start_date,
        $end_date
    ) {
        $acceptable_type = ['purchase', 'selling'];
        if (!in_array($type, $acceptable_type)) return Redirect::to('route-verify');

        try {
            $starting_date = Carbon::createFromFormat('Y-m-d', $start_date);
            $ending_date = Carbon::createFromFormat('Y-m-d', $end_date);
        } catch(Execption $e) {
            abort(404);
        }

        $transactions = Transaction::whereBetween(
            'transactions.updated_at',
            [
                $starting_date->format('Y-m-d 00:00:00'),
                $ending_date->format('Y-m-d 23:59:59')
            ]
        )->where([
            'status' => $request->status,
            'type' => $type
        ])->where('total', '>=', $request->nominal)
        ->orderBy('created_at', 'desc')
        ->paginate(5)
        ->appends(request()->query());;

        $type = ($type == 'purchase') ? "Pembelian" : "Penjualan";

        view()->share([
            'type' => $type,
            'starting_date' => $starting_date,
            'ending_date' => $ending_date,
            'transactions' => $transactions,
        ]);

        return view('admin.reports.transactions.index');

    }

}
