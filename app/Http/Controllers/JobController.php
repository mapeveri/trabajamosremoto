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
        $this->middleware('auth', ['except' => ['show', 'showCategory', 'showSubCategory']]);
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
        $subcategories_select = [];

        return view('job.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('subcategories_select', $subcategories_select);
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
     * @param $slug
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
        $subcategories_select = $job->subcategories->pluck('id')->toArray();

        return view('job.edit')
            ->with('job', $job)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('subcategories_select', $subcategories_select);
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
        Job::destroy($job->id);
        return redirect()->route('home');
    }

    /**
     * Get related jobs to category
     *
     * @param  $id Id category
     * @param  $slug slug category
     * @return \Illuminate\Http\Response
     */
    public function showCategory($id, $slug)
    {
        // Get category to get jobs
        $category = Category::where('id', $id)->where('slug', $slug)->firstOrFail();

        // Get jobs
        $jobs = Job::where('category_id', $id)
            ->orderBy('created_at', 'DESC')
            ->with('category')
            ->with('subcategories')
            ->paginate(15);

        return view('job.showCategory')
            ->with('category', $category)
            ->with('jobs', $jobs);
    }

    /**
     * Get related jobs to subcategory
     *
     * @param  $id Id category
     * @param  $slug slug category
     * @param  $subcategory_id Id subcategory
     * @param  $subcategory_slug slug subcategory
     * @return \Illuminate\Http\Response
     */
    public function showSubCategory($id, $slug, $subcategory_id, $subcategory_slug)
    {
        // Get subcategory to get jobs
        $subcategory = SubCategory::where('id', $subcategory_id)
            ->where('slug', $subcategory_slug)
            ->whereHas('category', function($q) use($slug) {
                $q->where('slug', $slug);
            })
            ->with('category')
            ->firstOrFail();

        // Get jobs
        $jobs = Job::where('category_id', $id)
            ->whereHas('subcategories', function($q) use($subcategory_id) {
                $q->where('subcategory_id', $subcategory_id);
            })
            ->with('category')
            ->with('subcategories')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('job.showSubCategory')
            ->with('subcategory', $subcategory)
            ->with('jobs', $jobs);
    }

    private function validateForm(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required'
        ];
        $niceNames = [
            'title' => 'Título',
            'content' => 'Contenido',
            'category_id' => 'Categoría',
            'subcategory_id' => 'Sub Categoría'
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

        $job->subcategories()->attach($request->get('subcategory_id'));
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
