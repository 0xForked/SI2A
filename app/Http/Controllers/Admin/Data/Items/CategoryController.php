<?php

namespace App\Http\Controllers\Admin\Data\Items;

use Illuminate\Http\Request;
use App\Models\Data\Category;
use App\Http\Controllers\Controller;

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
        $categories = Category::withCount('subcategories')->paginate(5);

        if ($request->search) {
            $categories = Category::withCount('subcategories')->where(
                'name',
                'LIKE',
                "%$request->search%"
            )->paginate(5);
        }

        return view('admin.item-mgmt.categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);
        return response()->json($categories);
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
            'description' => 'required',
        ]);
        $categories = $request->only('name', 'description');
        $action = Category::create($categories);
        if (!$action) {
            return redirect()->back()->with('error','Failed add new Category');
        }
        return redirect()->back()->with('success','Category created successfully');
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
        $categories = Category::findOrFail($request->id);
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->save();
        return redirect()->back()->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()
                ->route('admin.items.categories.index')
                ->with('success', 'Category delete successfully');
    }

}
