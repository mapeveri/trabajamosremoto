<?php

namespace App\Services;

use App\Category;

class CategoryService
{
    /**
     * Get category
     *
     * @param $id
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Collection|404
     */
    public function getCategory($id, $slug)
    {
        return Category::where('id', $id)->where('slug', $slug)->firstOrFail();
    }

    /**
     * Get list of categories for combobox
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategoriesCombo()
    {
        $categories = Category::pluck('name', 'id');
        $categories->prepend('', '');
        return $categories;
    }

    /**
     * Get list of categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCategories() {
        $categories = Category::with([
            'jobs' => function($query) {
                $query->orderBy('jobs.created_at', 'DESC');
            },
            'jobs.category',
            'jobs.subcategories',
            'jobs.user'
        ])->get();

        return $categories;
    }
}
