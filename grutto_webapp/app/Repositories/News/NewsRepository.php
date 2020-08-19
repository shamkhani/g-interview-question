<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends MariaDBRepository implements NewsRepositoryInterface
{

    public function getModelClass()
    {
        return News::class ;
    }

}
