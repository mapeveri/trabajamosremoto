<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function jobs()
    {
        return $this->belongsToMany('App\Job', 'jobs_subcategories', 'subcategory_id', 'job_id');
    }
}
