<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Models\Data\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function index(Request $request, $type)
    {
        $today = date('Y-m-d');
        $products = [];
        if ($type == 'purchase') $products = Product::paginate(2);
        if ($type == 'selling') {
            $products = Product::where('stock', '>', 0)
                                ->where('expired_date', '>=', $today)
                                ->paginate(2);
        }

        if ($request->ajax()) {
            return view('admin.transactions.product', compact('products'))->render();
        }

        return view('admin.transactions.index', compact('products'));

    }

}
