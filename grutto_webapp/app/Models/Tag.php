<?php
namespace App\Models;
use App\Models\MariaDBModel;

class Tag extends MariaDBModel{

    public $timestamps = false;
    protected $fillable = [
        'title'
    ];

    public function news()
    {
        return $this->belongsToMany('News');
    }
}
