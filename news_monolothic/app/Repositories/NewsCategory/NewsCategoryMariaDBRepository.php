<?php

namespace App\Repositories;

use App\Models\NewsCategory;

class NewsCategoryRepository extends MariaDBRepository implements NewsCategoryRepositoryInterface
{

    public function getModelClass()
    {
        return NewsCategory::class ;
    }

}
