<?php

namespace App\Http\Controllers\Admin\Data\Items;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
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

        return view('admin.item-mgmt.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);
        // $marital = $request->only('name', 'description');
        // $action = Marital::create($marital);
        // if (!$action) {
        //     return redirect()->back()->with('error','Failed add new Marital Status');
        // }
        // return redirect()->back()->with('success','Marital status created successfully');
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
        // $this->validate($request, [
        //     'name' => 'required',
        // ]);
        // $marital = Marital::findOrFail($request->id);
        // $marital->name = $request->name;
        // $marital->description = $request->description;
        // $marital->save();
        // return redirect()->back()->with('success','Marital status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Marital::findOrFail($id)->delete();
        // return redirect()
        //         ->route('admin.general.maritals.index')
        //         ->with('success', 'Marital status delete successfully');
    }

}
