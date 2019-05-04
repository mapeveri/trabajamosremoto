<?php

namespace App\Services;

use App\SubCategory;

class SubCategoryService
{
    /**
     * Get SubCategories to combobox
     *
     * @param $category_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSubCategoriesCombo($category_id)
    {
        return SubCategory::where('category_id', $category_id)->pluck('name', 'id');
    }

    /**
     * Get subcategories
     *
     * @param $category_slug
     * @param $subcategory_id
     * @param $subcategory_slug
     * @return \Illuminate\Database\Eloquent\Collection|404
     */
    public function getSubCategories($category_slug, $subcategory_id, $subcategory_slug)
    {
        $subcategory = SubCategory::where('id', $subcategory_id)
            ->where('slug', $subcategory_slug)
            ->whereHas('category', function($q) use($category_slug) {
                $q->where('slug', $category_slug);
            })
            ->with('category')
            ->firstOrFail();

        return $subcategory;
    }
}
