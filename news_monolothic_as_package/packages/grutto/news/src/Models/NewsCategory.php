<?php
namespace Grutto\News\Models;


class NewsCategory extends MariaDBModel{

    public $timestamps=false;
    protected $fillable  = [
        'parent_id',
        'title',
        'slug',
    ];

    protected $with=['parent'];

    public function news()
    {
        return $this->hasMany(News::class,'category_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(NewsCategory::class,'parent_id');
    }
}
