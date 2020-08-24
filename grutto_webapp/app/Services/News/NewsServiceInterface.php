<?php
namespace App\Services;

use App\Models\News;
use App\Models\NewsCategory;
use Highlight\Mode;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

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
    public function updateNews(array  $data, int $id) : Model;

    /**
     * @param $id
     * @return bool
     */
    public function removeNews(int $id) : bool;


    /**
     * @return mixed
     */
    public function getAllNewsCategoryForNewsList();


    /**
     * @param int $items
     * @param array $columns
     * @return mixed
     */
    public function getAllNewsCategoryByPagination(int $items = 10, array $columns=[]);

    /**
     * @param $id
     * @return NewsCategory
     */
    public function getNewsCategoryById(int $id) : NewsCategory;


    /**
     * @param array $data
     * @return \App\Models\MariaDBModel|NewsCategory
     */
    public function createNewsCategory(array $data) : NewsCategory;

    /**
     * @param array $data
     * @param int $id
     * @return \App\Models\MariaDBModel|NewsCategory
     */
    public function updateNewsCategory(array  $data, int $id) : bool ;

    /**
     * @param $id
     * @return bool
     */
    public function removeNewsCategory(int $id) : bool;

    /**
     * @param int $cid
     * @return mixed
     */
    public function getNewsByCategoryId(int $cid);

    /**
     * @param array $cids
     * @return mixed
     */
    public function getNewsByCategoryIds(array $cids);
}
