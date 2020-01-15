<?php

namespace App\Http\Controllers\Admin\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data\Customer;

class CustomerController extends Controller
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
        $customers = Customer::paginate(5);

        if ($request->search) {
            $customers = Customer::where(
                'name',
                'LIKE',
                "%$request->search%"
            )->paginate(5);
        }

        return view('admin.customer-mgmt.index', compact('customers'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
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
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $customer = $request->only('name', 'address', 'email', 'phone');
        $action = Customer::create($customer);
        if (!$action) {
            return redirect()->back()->with('error','Failed add new Customer');
        }
        return redirect()->back()->with('success','Customer created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $customer = Customer::findOrFail($request->id);
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect()->back()->with('success','Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect()
                ->route('admin.customers.index')
                ->with('success', 'Customer delete successfully');
    }

}