<?php

namespace Grutto\News\Controllers\API\V1;

use Grutto\News\Controllers\Controller;
use Grutto\News\Controllers\API\APIController;
use Grutto\News\Requests\NewsRequest;
use Grutto\News\\News;
use Grutto\News\\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class NewsController
 * @package Grutto\News\Controllers
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
    public function index(Request $request)
    {
        try{
            $idsString = $request->get('cids');
            if($idsString){
               $ids = explode(',',$idsString);
                $news = $this->newsService->getNewsByCategoryIds($ids);
                return NewsResource::collection($news);
            }
            $news = $this->newsService->getAllNewsByPagination();

            return NewsResource::collection($news);
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error(Common\ResponseService::STATUS_CODE_FLOW_ERROR_500, $ex->getMessage());
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
        $errorsItem = [];
        $ids = $request->get('ids');
        try{
            foreach ($ids as $id){
                $result = $this->newsService->removeNews($id);
                if($result){
                    array_push($deletedItem, $id);
                }else{
                    array_push($errorsItem, $id);
                }
            }

            if ($deletedItem){
                return Common\ResponseService::success($deletedItem,count($deletedItem) . " news item(s) has been deleted.");
            }
            return Common\ResponseService::error(500,count($errorsItem) . " have been faced to error during delete process.");

        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            if($ex->getCode()==23000){
                return Common\ResponseService::error(500, 'news you selected to delete has related items, please delete them first.');;
            }
            return Common\ResponseService::error(500,$ex->getMessage());

        }
    }

}
