<?php
namespace App\Services;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;

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


    /**
     * @param array $data
     * @return \App\Models\MariaDBModel|News
     */
    public function createNews(array $data) : News;

    /**
     * @param array $data
     * @param int $id
     * @return \App\Models\MariaDBModel|News
     */
    public function updateNews(array  $data, int $id) : News;

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
