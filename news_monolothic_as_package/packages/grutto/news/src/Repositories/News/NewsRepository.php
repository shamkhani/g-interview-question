<?php

namespace Grutto\News\Repositories;

use Grutto\News\Models\MariaDBModel;
use Grutto\News\Models\News;

class NewsRepository extends MariaDBRepository implements NewsRepositoryInterface
{


    public function getModelClass()
    {
        return  News::class;
    }

    /**
     * Return news by selected category ids
     * @param array $cids
     * @return mixed|void
     */
    public function getNewsByCategoryIds(array $cids)
    {
        return $this->model->whereIn('category_id',$cids )->get()->take(3);
    }

}
