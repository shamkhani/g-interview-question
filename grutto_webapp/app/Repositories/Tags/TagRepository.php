<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends MariaDBRepository implements TagRepositoryInterface
{

    public function getModelClass()
    {
        return Tag::class ;
    }

}
