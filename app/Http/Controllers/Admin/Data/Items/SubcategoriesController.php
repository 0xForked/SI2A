<?php

namespace App\Http\Controllers\Admin\Data\Items;

use Illuminate\Http\Request;
use App\Models\Data\Category;
use App\Models\Data\Subcategory;
use App\Http\Controllers\Controller;

class SubcategoriesController extends Controller
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
        $categories = Category::all();

        $subcategories = Subcategory::with('category')->withCount('products')->paginate(5);
        if ($request->search) {
            $subcategories = Subcategory::with('category')->withCount('products')->where(
                'name',
                'LIKE',
                "%$request->search%"
            )->paginate(5);
        }

        return view('admin.item-mgmt.subcategories.index', compact('categories', 'subcategories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return response()->json($subcategory);
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
        ]);
        $subcategory = $request->only('name', 'description', 'category_id');
        $action = Subcategory::create($subcategory);
        if (!$action) {
            return redirect()->back()->with('error','Failed add new Subcategory');
        }
        return redirect()->back()->with('success','Subcategory created successfully');
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
        ]);
        $subcategory = Subcategory::findOrFail($request->id);
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect()->back()->with('success','Subcategory updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategory::findOrFail($id)->delete();
        return redirect()
                ->route('admin.items.subcategories.index')
                ->with('success', 'Subcategory delete successfully');
    }

}
