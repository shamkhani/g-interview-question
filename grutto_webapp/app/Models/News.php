<?php
namespace App\Models;


use Carbon\Carbon;

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

    public function getPublishDateAttribute()
    {
        if($this->attributes['publish_date']){
            return  date('Y-m-d', strtotime($this->attributes['publish_date']));
        }

    }
    public function getCreatedAtAttribute()
    {
        if($this->attributes['created_at']){
            return  date('Y-m-d h:i:s', strtotime($this->attributes['created_at']));
        }

    }
    public function getUpdatedAtAttribute()
    {
        if($this->attributes['updated_at']){
            return  date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
        }

    }


}
