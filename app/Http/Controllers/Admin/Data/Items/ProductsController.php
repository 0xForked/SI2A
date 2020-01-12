<?php

namespace App\Http\Controllers\Admin\Data\Items;

use App\Models\Data\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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

        return view('admin.item-mgmt.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function status($status)
    {
        // on this function
        // we will validate user status 'Activate' or not
        // and every action will send notify to user via
        // email, phone or other . . . .
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}