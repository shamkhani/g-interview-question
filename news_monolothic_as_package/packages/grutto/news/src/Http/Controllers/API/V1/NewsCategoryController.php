<?php

namespace Grutto\News\Controllers\API\V1;

use Grutto\News\Controllers\API\APIController;
use Grutto\News\Requests\NewsCategoryRequest;
use Grutto\News\Requests\NewsCategoryRequestRequest;
use Grutto\News\Resources\NewsCategoryResource;
use Grutto\News\\NewsCategory;
use Grutto\News\\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class NewsController
 * @package Grutto\News\Controllers
 */
class NewsCategoryController extends APIController
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
//        try{
//        dd();
                return NewsCategoryResource::collection( $this->newsService->getAllNewsCategoryByPagination());


//        }catch (\Exception $ex){
//            Common\Logger::logError($ex);
//            return  Common\ResponseService::error(500, $ex);
//        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $result = $this->newsService->removeNewsCategory($id);
            if($result){
               return Common\ResponseService::create([], "News category $id has been delete");
            }
            return Common\ResponseService::create([], 'NewsCategory can not delete! there is a problem, Please ensure the category has not any news items');;
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            if($ex->getCode()==23000){
                return Common\ResponseService::error(500, 'Category you selected to delete has news items, please delete them first.');;
            }
            return Common\ResponseService::error(500, $ex->getMessage());;

        }
    }

    /**
     * Delete category by given ids
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
                $result = $this->newsService->removeNewsCategory($id);
                if($result){
                    array_push($deletedItem, $id);
                }else{
                    array_push($errorsItem, $id);
                }
            }

            if ($deletedItem){
                return Common\ResponseService::success($deletedItem,count($deletedItem) . " category(ies) has been deleted.");
            }
            return Common\ResponseService::error(500,count($errorsItem) . " category(ies) you select have news items, please delete them first.");

        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            if($ex->getCode()==23000){
                return Common\ResponseService::error(500, 'Category you selected to delete has news items, please delete them first.');;
            }
            return Common\ResponseService::error(500,$ex->getMessage());

        }
    }
}
