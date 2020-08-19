<?php
namespace App\Services;

use App\Models\News;

interface NewsServiceInterface {

    /**
     * @param int $items
     * @param array $columns
     * @return mixed
     */
    public function getAllNewsByPagination(int $items = 10, array $columns=[]);

    /**
     * @param $id
     * @return News
     */
    public function getNewsById(int $id) : News;

    public function createNews(array $data) : News;

    /**
     * @param $data
     * @param $id
     * @return News
     */
    public function updateNews(array $data, int $id) : News;

    /**
     * @param $id
     * @return bool
     */
    public function removeNews(int $id) : bool;


    /**
     * @return mixed
     */
    public function getAllNewsCategoryForNewsList();
}
