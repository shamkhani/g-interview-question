<?php
namespace App\Models;
use App\Models\MariaDBModel;

class Tag extends MariaDBModel{

    protected $timestamp = false;
    protected $guarded = [
        'title'
    ];

    public function news()
    {
        return $this->belongsToMany('News');
    }
}
