<?php

namespace App\Services;

use App\Models\News;
use App\Repositories\NewsCategoryRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\TagRepositoryInterface;



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
     * @return News
     */
    public function getNewsById(int $id) : News
    {
        return $this->newsRepository->getModelById($id);
    }
    public function createNews(array $data) : News
    {
        return $this->newsRepository->create($data);
    }

    /**
     * @param $data
     * @param $id
     * @return News
     */
    public function updateNews(array $data, int $id) : News
    {
        return $this->newsRepository->update($data, $id);
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
        $this->newsCategoryRepository->getAll(100,['id','title']);
    }
}
