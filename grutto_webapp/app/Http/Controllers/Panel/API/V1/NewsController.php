<?php

namespace App\Http\Controllers\Panel\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Panel\API\APIController;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Resources\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends APIController
{
    /**
     * @var NewsServiceInterface
     */
    private $newsService;

    /**
     * NewsController constructor.
     * @param NewsServiceInterface $newsService
     */
    public function __construct(NewsServiceInterface $newsService)
    {
        $this->newsService = $newsService;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $news = $this->newsService->getAllNewsByPagination();
            return NewsResource::collection($news);
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error(500, $ex);
        }
    }

    /**
     * @param News $news
     * @return News
     */
    public function getNewsItem(News $news)
    {
        return $news;
    }

    /**
     * Return list of news items by category id
     * Also We can also find the news items by category's slug
     * @param Request $request
     * @param $cid
     * @param $slug
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getNewsByCategoryId(Request $request,$cid, $slug)
    {
        $news = $this->newsService->getNewsByCategoryId($cid);
        return NewsResource::collection($news);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $result = $this->newsService->removeNews($id);
            if($result){
                return Common\ResponseService::success("Item with it $id has beeen deleted");
            }
            return redirect(route('news.index'))->with(['error'=>'News can not delete! there is a problem']);
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error(500, $ex);
        }

    }

    /**
     * Delete News items by given ids
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Response
     */
    public function destroyByIds(Request $request)
    {
        $deletedItem = [];
        $ids = $request->getQueryString('ids');
        try{
            foreach ($ids as $id){
                $result = $this->newsService->removeNews($id);
                if($result){
                    Arr::add($deletedItem,$id);
                }
            }
            if ($deletedItem){
                return Common\ResponseService::success($deletedItem,"Items have beeen deleted");
            }
            return Common\ResponseService::error(500,'News can not delete! there is a problem');
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return Common\ResponseService::error(500,'News can not delete! there is a problem');

        }
    }

}
