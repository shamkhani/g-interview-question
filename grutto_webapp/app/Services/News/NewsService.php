<?php

namespace App\Services;

use App\Models\News;
use App\Models\NewsCategory;
use App\Repositories\NewsCategoryRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class NewsService implements NewsServiceInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    protected $newsRepository;

    /**
     * @var NewsCategoryRepositoryInterface
     */
    protected $newsCategoryRepository;

    /**
     * @var TagRepositoryInterface
     */
    protected $tagRepository;



    public function __construct(NewsRepositoryInterface $newRepository,
                                NewsCategoryRepositoryInterface $newsCategoryRepository,
                                TagRepositoryInterface $tagRepository)
    {
        $this->newsRepository = $newRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param int $items
     * @param array $columns
     * @return mixed
     */
    public function getAllNewsByPagination(int $items = 10, array $columns=[])
    {
        return $this->newsRepository->getAll($items, $columns);
    }

    /**
     * @param $id
     * @return \App\Models\MariaDBModel|News
     */
    public function getNewsById(int $id) : News
    {
        return $this->newsRepository->getModelById($id);
    }

    /**
     * @param array $data
     * @return \App\Models\MariaDBModel|News
     */
    public function createNews(array $data) : News
    {
        return $this->newsRepository->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return \App\Models\MariaDBModel|News.
     */
    public function updateNews(array $data, int $id) : bool
    {
        return $this->newsRepository->updateById($data, $id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function removeNews(int $id) : bool
    {
        return $this->newsRepository->removeById($id);
    }

    /**
     * @return mixed|void
     */
    public function getAllNewsCategoryForNewsList()
    {
        return $this->newsCategoryRepository->getAll(0,['id','title']);
    }



    /**
     * @param int $items
     * @param array $columns
     * @return mixed
     */
    public function getAllNewsCategoryByPagination(int $items = 10, array $columns=[])
    {
        return $this->newsCategoryRepository->getAll($items, $columns);
    }

    /**
     * @param $id
     * @return \App\Models\MariaDBModel|NewsCategory
     */
    public function getNewsCategoryById(int $id) : NewsCategory
    {
        return $this->newsCategoryRepository->getModelById($id);
    }

    /**
     * @param array $data
     * @return \App\Models\MariaDBModel|NewsCategory
     */
    public function createNewsCategory(array $data) : NewsCategory
    {
        return $this->newsCategoryRepository->create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return \App\Models\MariaDBModel|NewsCategory.
     */
    public function updateNewsCategory(array $data, int $id) : bool
    {
        return $this->newsCategoryRepository->updateById($data, $id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function removeNewsCategory(int $id) : bool
    {
        return $this->newsCategoryRepository->removeById($id);
    }

    /**
     * @param int $cid
     * @return bool|mixed|null
     */
    public function getNewsByCategoryId(int $cid){
        return $this->newsRepository->find([["category_id",'=',$cid]],false);
    }
}
