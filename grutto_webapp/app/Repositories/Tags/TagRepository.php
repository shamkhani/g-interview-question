<?php

namespace App\Repositories;

use App\Models\Tag;
use Illuminate\Support\Arr;

class TagRepository extends MariaDBRepository implements TagRepositoryInterface
{

    public function getModelClass()
    {
        return Tag::class ;
    }

    /**
     * Find in Tags where names are in given array
     * @param array $tags
     */
    public function getTagsIdsByNames(array $tags)
    {
       return $this->getModel()->whereIn('title',$tags)->get()->pluck('id');
    }
}
