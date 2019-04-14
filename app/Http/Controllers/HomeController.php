<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with([
            'jobs' => function($query) {
                $query->orderBy('jobs.created_at', 'DESC');
            },
            'jobs.category',
            'jobs.subcategories',
            'jobs.user'
        ])->get();

        return view('home')->with('categories', $categories);
    }
}
