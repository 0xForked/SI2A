<?php

namespace App\Http\Controllers\Admin\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data\Supplier;

class SupplierController extends Controller
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
        $suppliers = Supplier::paginate(5);

        if ($request->search) {
            $suppliers = Supplier::where(
                'name',
                'LIKE',
                "%$request->search%"
            )->paginate(5);
        }

        return view('admin.supplier-mgmt.index', compact('suppliers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
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
            'city' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $supplier = $request->only('name', 'address', 'city', 'email', 'phone');
        $action = Supplier::create($supplier);
        if (!$action) {
            return redirect()->back()->with('error','Failed add new Supplier');
        }
        return redirect()->back()->with('success','Supplier created successfully');
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
            'city' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $supplier = Supplier::findOrFail($request->id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->city = $request->city;
        $supplier->save();
        return redirect()->back()->with('success','Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return redirect()
                ->route('admin.suppliers.index')
                ->with('success', 'Supplier delete successfully');
    }
}