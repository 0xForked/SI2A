<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Models\Transaction;
use App\Models\Data\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data\Customer;
use App\Models\Data\Supplier;
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
        $uncompleted_transactions = [];
        if ($transaction) {
            $uncompleted_transactions = Transaction::where('status', 'UNCOMPLETED')
                                                    ->where('id', '!=' , $transaction->id)
                                                    ->get();
        }
        $customers = Customer::all();
        $suppliers = Supplier::all();
        if ($request->ajax()) return view(
            'admin.transactions.product',
            compact('products', 'transaction', 'uncompleted_transactions', 'customers', 'suppliers')
        )->render();
        return view(
            'admin.transactions.index',
            compact('products', 'transaction', 'uncompleted_transactions', 'customers', 'suppliers')
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

    public function process(Request $request, $transaction_id)
    {
        $transaction = Transaction::with('items')->findOrFail($transaction_id);
        dd($transaction);
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
            $transaction_item->qty =  $transaction_item->qty + 1;
            $transaction_item->net = $transaction_item->net + $price;
            $transaction_item->total = $transaction_item->total + $price;
            $transaction_item->save();
            $this->calculateTransaction($transaction_id);
            return Redirect::back()->with(
                'success',
                "Added $product->name qty to cart!"
            );
        }
        if (!$transaction_item) {
            $action = TransactionItem::create($data);
            $this->calculateTransaction($transaction_id);
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

    public function deleteItem(Request $request, $id)
    {
        $transaction_item = TransactionItem::findOrFail($id);
        $transaction_item->delete();
        $this->calculateTransaction($transaction_item->transaction_id);
        return Redirect::back()->with(
            'success',
            "$transaction_item->name deleted from cart!"
        );
    }

    public function addItemQty(Request $request)
    {
        $transaction_item = TransactionItem::findOrFail($request->item_id);
        $transaction_item->qty = $request->add_qty;
        $transaction_item->net = $transaction_item->price *  $request->add_qty;
        $transaction_item->total = $transaction_item->price *  $request->add_qty;
        $transaction_item->save();
        $this->calculateTransaction($transaction_item->transaction_id);
        return Redirect::back()->with(
            'success',
            "Added $transaction_item->name qty to cart!"
        );
    }

    private function calculateTransaction($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction_item = TransactionItem::where('transaction_id', $transaction_id)->get();
        $item_price = 0;
        foreach ($transaction_item as $item) {
            $item_price += $item->price * $item->qty;
        }
        $brutto = $item_price;
        $disc = $transaction->disc;
        $netto = $brutto - ($brutto * ($disc/100));
        $tax =  (($netto * $disc) / 100);
        $total = $netto + $tax;
        $transaction->brutto  = $brutto;
        $transaction->disc = $disc;
        $transaction->netto = $netto;
        $transaction->tax = $transaction->tax;
        $transaction->total = $total;
        $transaction->save();
    }

    private function printReport()
    {
        // todo print report after process
    }
}
