<?php
namespace Grutto\News\Repositories;

interface NewsRepositoryInterface extends MariaDBRepositoryInterface
{

    /**
     * Return list of news by selected category ids
     * @param array $cids
     * @return mixed
     */
    public function getNewsByCategoryIds(array $cids);

}
