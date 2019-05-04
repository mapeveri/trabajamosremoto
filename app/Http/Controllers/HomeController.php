<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class HomeController extends Controller
{
    /**
    * @var categoryService
    */
    protected $categoryService;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(CategoryService $cService)
    {
        $this->categoryService = $cService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->categoryService->getCategories();

        return view('home')->with('categories', $categories);
    }
}
