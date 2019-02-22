<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Category;
use App\SubCategory;
use App\User;

class AdminHomeController extends Controller
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

    public function index() {
        $users = User::get()->count();
        $categories = Category::get()->count();
        $subcategories = SubCategory::get()->count();

        return view('admin.home')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('users', $users);
    }
}
