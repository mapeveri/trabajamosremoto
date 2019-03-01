<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
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

    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $category = new Category;
        $this->saveData($category, $request);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $category = Category::findOrFail($id);
        $this->saveData($category, $request);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index');
    }

    private function saveData($category, Request $request)
    {
        $category->name = $request->input('name');
        $category->save();
    }

    private function validateForm(Request $request) {
        $rules = [
            'name' => 'required'
        ];
        $niceNames = [
            'name' => 'Nombre'
        ];

        $this->validate($request, $rules, [], $niceNames);
    }
}
