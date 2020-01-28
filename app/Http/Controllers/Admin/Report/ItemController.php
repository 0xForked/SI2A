<?php

namespace App\Http\Controllers\Admin\Report;

use App\Models\Data\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
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
        $acceptable_type = ['expired', 'stock'];
        if (!in_array($type, $acceptable_type)) return Redirect::to('route-verify');

        $products = Product::with('unit')->with(['subcategory' => function($query) {
            $query->with('category');
        }])->paginate(5);

        if ($request->search_key && $request->search_value) {
            $products = Product::with('unit')->with(['subcategory' => function($query) {
                $query->with('category');
            }])->where(
                "$request->search_key",
                'LIKE',
                "%$request->search_value%"
            )->paginate(5);
        }

        $type = ($type == 'expired') ? "Kedaluwarsa" : "Stok";
        view()->share([
            'type' => $type,
            'products' => $products
        ]);

        return view('admin.reports.items.index');
    }

}
