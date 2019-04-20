<?php

namespace Tests\Feature;

use Tests\TestCase;

class JobTest extends TestCase
{
    /**
     * Test show category jobs
     *
     * @return void
     */
    public function testShowCategoryJobs()
    {
        $category = \App\Category::all()->first();
        $response = $this->get('/jobs/category/' . $category->id . '/' . $category->slug);

        $response->assertStatus(200);
    }

    /**
     * Test show subcategory jobs
     *
     * @return void
     */
    public function testshowSubCategoryJobs()
    {
        $subcategory = \App\SubCategory::all()->first();
        $category = $subcategory->category;
        $response = $this->get('/jobs/category/' . $category->id . '/' . $category->slug . '/' . $subcategory->id . '/' . $subcategory->slug);

        $response->assertStatus(200);
    }

    /**
     * Test show job
     *
     * @return void
     */
    public function testShowJob()
    {
        $job = \App\Job::all()->first();
        $response = $this->get('/jobs/' . $job->id . '/' . $job->slug);

        $response->assertStatus(200);
    }
}
