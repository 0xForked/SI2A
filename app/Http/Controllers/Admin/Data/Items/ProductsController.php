<?php

namespace App\Http\Controllers\Admin\Data\Items;

use Subcategories;
use App\Models\Data\Unit;
use App\Models\Data\Product;
use Illuminate\Http\Request;
use App\Models\Data\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Data\ProductModifiedHistory;
use App\Models\Transaction;
use App\Models\TransactionItem;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('unit')
                        ->with(['subcategory' => function($query) {
                            $query->with('category');
                        }])->with(['modifiedHistories' => function($query) {
                            $query->with('user:id,name');
                        }])->findOrFail($id);

        $transaction_item_purchases = TransactionItem::where('product_id', $id)->with([
            'transaction' => function($query) {
                $query->where([
                    'type' => 'purchase',
                    'status' => 'COMPLETE'
                ]);
            }
        ])->orderBy('created_at', 'desc')->limit(6)->get();

        $transaction_item_selling = TransactionItem::where('product_id', $id)->with([
            'transaction' => function($query) {
                $query->where([
                    'type' => 'selling',
                    'status' => 'COMPLETE'
                ]);
            }
        ])->orderBy('created_at', 'desc')->limit(6)->get();

        return view(
            'admin.item-mgmt.products.show',
            compact('product', 'transaction_item_purchases', 'transaction_item_selling')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.item-mgmt.products.add', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sku' => 'required|unique:products,sku',
            'bets_number' => 'required',
            'marketing_authorization_number' => 'required',
            'expired_date' => 'required',
            'name' => 'required',
            'price_buy' => 'required',
            'price_sell' => 'required',
            'unit_id' => 'required',
            'subcategory_id' => 'required',
            'status' => 'required',
        ]);

        $data = $request->only(
            'sku',
            'bets_number',
            'marketing_authorization_number',
            'expired_date',
            'name',
            'price_buy',
            'price_sell',
            'unit_id',
            'subcategory_id',
            'status'
        );

        $action = Product::create($data);

        if (!$action) {
            return redirect()->back()->with('error','Failed add new Product');
        }

        return redirect()
            ->route('admin.items.products.index')
            ->with('success', 'Products successfully added with default stock is 0.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $units = Unit::all();
        $product = Product::with(['subcategory' => function($query) {
            $query->with('category');
        }])->find($id);
        return view('admin.item-mgmt.products.edit', compact('categories', 'units', 'product'));
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
        //  todo jangan tambah di modified kalau data sama

        $product = Product::findOrFail($id);

        $product_origin = $product->only(
            'sku',
            'bets_number',
            'marketing_authorization_number',
            'expired_date',
            'name',
            'price_buy',
            'price_sell',
            'unit_id',
            'subcategory_id',
            'status'
        );

        $product_modified = $request->only(
            'sku',
            'bets_number',
            'marketing_authorization_number',
            'expired_date',
            'name',
            'price_buy',
            'price_sell',
            'unit_id',
            'subcategory_id',
            'status'
        );

        $modified_history = [
            'product_id' => (Int)$id,
            'before' => json_encode($product_origin),
            'after' => json_encode($product_modified),
            'user_id' => Auth::user()->id,
        ];

        $product->update($product_modified);

        ProductModifiedHistory::create($modified_history);

        return redirect()
            ->route('admin.items.products.index')
            ->with('success', 'Product successfully edited.');
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
        ProductModifiedHistory::where('product_id', $id)->delete();
        Product::findOrFail($id)->delete();
        return redirect()
                ->route('admin.items.products.index')
                ->with('success', 'Product delete successfully');
    }
}