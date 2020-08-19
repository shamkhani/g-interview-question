<?php
namespace App\Models;
use App\Models\MariaDBModel;

class News extends MariaDBModel{
    protected $guarded = [
        'category_id' ,
        'title',
        'slug',
        'short_description',
        'description',
        'feature_image' ,
        'external_url',
        'publish_date' ,
        'status' ,
        'created_by' ,
        'updated_by'
    ];
    public $with = ['category','tags'];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
