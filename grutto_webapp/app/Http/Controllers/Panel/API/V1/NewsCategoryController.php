<?php

namespace App\Http\Controllers\Panel\API\V1;

use App\Http\Controllers\Panel\API\APIController;
use App\Http\Requests\NewsCategoryRequest;
use App\Http\Requests\NewsCategoryRequestRequest;
use App\Http\Resources\NewsCategoryResource;
use App\Models\NewsCategory;
use App\Resources\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Http\Request;

/**
 * Class NewsController
 * @package App\Http\Controllers
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
            return Common\ResponseService::create([], 'NewsCategory can not delete! there is a problem');;
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return Common\ResponseService::error(500, 'NewsCategory can not delete! there is a problem');;
        }

    }
}
