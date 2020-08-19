<?php
namespace App\Models;
use App\Models\MariaDBModel;

class NewsCategory extends MariaDBModel{

    protected $fillable  = [
        'parent_id',
        'title',
        'slug',
    ];

    public function news()
    {
        return $this->hasMany('News');
    }
}
