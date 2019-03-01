<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Category;
use App\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return view('admin.subcategory.index')->with('subcategories', $subcategories);
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.subcategory.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $subcategory = new SubCategory;
        $this->saveData($subcategory, $request);

        return redirect()->route('subcategories.index');
    }

    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = $this->getCategories();

        return view('admin.subcategory.edit')
            ->with('subcategory', $subcategory)
            ->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $subcategory = SubCategory::findOrFail($id);
        $this->saveData($subcategory, $request);

        return redirect()->route('subcategories.index');
    }

    public function destroy($id)
    {
        SubCategory::destroy($id);
        return redirect()->route('subcategories.index');
    }

    private function validateForm(Request $request)
    {
        $rules = [
            'name' => 'required',
            'category_id' => 'required'
        ];
        $niceNames = [
            'name' => 'Nombre',
            'category_id' => 'Categoría'
        ];

        $this->validate($request, $rules, [], $niceNames);
    }

    private function saveData($subcategory, Request $request)
    {
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $request->input('category_id');
        $subcategory->slug = Str::slug($subcategory->name, '-');
        $subcategory->save();
    }

    private function getCategories()
    {
        $categories = Category::pluck('name', 'id');
        return $categories;
    }
}
