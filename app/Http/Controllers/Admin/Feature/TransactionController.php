<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Models\Transaction;
use App\Models\Data\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        if ($type == 'purchase')
            $products = Product::paginate(2);
        if ($type == 'selling')
            $products = Product::where('stock', '>', 0)
                                ->where('expired_date', '>=', $today)
                                ->paginate(2);

        $transaction = Transaction::where([
            'type' => $type,
            'status' => 'UNCOMPLETED'
        ])->with('items')->latest('created_at')->first();

        if ($request->ajax()) return view(
            'admin.transactions.product',
            compact('products', 'transaction')
        )->render();

        return view(
            'admin.transactions.index',
            compact('products', 'transaction')
        );
    }

    public function open(Request $request, $type)
    {
        //Purchase Order (PO) | Selling Order (SO)
        $type = ($type == 'purchase') ? "PO" : "SO";
        $data = [
            'ref_no' => 'TRA'.date('ymd').$type.rand(1000, 9999),
            'recipient_id' => Auth::user()->id,
        ];
        $validate = Transaction::where([

            'type' => $type,
            'status' => 'UNCOMPLETED'
        ])->latest('created_at')->first();

        if ($validate) return Redirect::back()->with(
            'error',
            'You have uncompleted transaction'
        );

        $open = Transaction::create($data);

        if ($open) return Redirect::back()->with(
            'success',
            'Transaction created with Ref : '.$data['ref_no']
        );

        return;
    }

    public function process()
    {
        //
    }

    public function addItem(Request $request, $transaction_id, $product_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $product = Product::findOrFail($product_id);
        $price = ($transaction->type == 'PURCHASE') ? $product->price_buy : $product->price_sell;
        $data = [
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $price,
            'disc' => 0,
            'net' => $price,
            'tax' => 0,
            'total' => $price
        ];

        $transaction_item = TransactionItem::where([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id
        ])->first();
        if ($transaction_item) {
            $transaction_item->qty = $transaction_item->qty + 1;
            $transaction_item->price = $transaction_item->price + $price;
            $transaction_item->net = $transaction_item->net + $price;
            $transaction_item->total = $transaction_item->total + $price;
            $transaction_item->save();
        }

        if (!$transaction_item) {
            $action = TransactionItem::create($data);
            if (!$action) return Redirect::back()->with(
                'error',
                'Failed add item on this transaction'
            );
        }

        return Redirect::back()->with(
            'success',
            "$product->name added to cart!"
        );
    }

    public function deleteItem(Request $request, $product_id)
    {
        $transaction_item = TransactionItem::where([
            'product_id' => $product_id
        ])->first();

        dd($transaction_item);
    }


}
