<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Job;
use App\SubCategory;

class JobController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();
        $categories = $categories->prepend('', '');
        $subcategories = [];
        return view('job.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        $job = new Job;
        $this->saveData($job, $request);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $job = Job::where('id', $id)->where('slug', $slug)->with('subcategories')->firstOrFail();
        return view('job.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $categories = $this->getCategories();
        $categories = $categories->prepend('', '');
        $subcategories = $this->getSubCategories($job->category_id);

        return view('job.edit')
            ->with('job', $job)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->validateForm($request);
        $this->saveData($job, $request);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        Job::destroy($job);
        return redirect()->route('home');
    }

    private function validateForm(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'subcategories' => 'required'
        ];
        $niceNames = [
            'title' => 'Título',
            'content' => 'Contenido',
            'category_id' => 'Categoría',
            'subcategories' => 'Sub Categoría'
        ];

        $this->validate($request, $rules, [], $niceNames);
    }

    private function saveData($job, Request $request)
    {
        $job->title = $request->input('title');
        $job->slug = Str::slug($job->title, '-');
        $job->content = $request->input('content');
        $job->category_id = $request->input('category_id');
        $job->user_id = \Auth::user()->id;
        $job->save();

        $job->subcategories()->attach($request->get('subcategories'));
    }

    private function getCategories()
    {
        $categories = Category::pluck('name', 'id');
        return $categories;
    }

    private function getSubCategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->pluck('name', 'id');
        return $subcategories;
    }
}