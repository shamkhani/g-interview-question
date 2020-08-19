<?php
namespace App\Models;


class News extends MariaDBModel{

    protected  $created_by;
    protected  $updated_by;

    protected $fillable  = [
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
