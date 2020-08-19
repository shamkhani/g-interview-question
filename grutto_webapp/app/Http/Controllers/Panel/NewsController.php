<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Resources\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Http\Request;

/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends Controller
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
//            if($request->ajax()) // This is check ajax request
//            {
//                $news = $this->newsService->getAllNewsByPagination();
//                return NewsResource::collection($news);
//            }

            return view('panel.news.index');

//        }catch (\Exception $ex){
//            Common\Logger::logError($ex);
//            return  Common\ResponseService::error(500, $ex);
//        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $newsCategories = $this->newsService->getAllNewsCategoryForNewsList();
        return view('panel.news.new', compact('newsCategories'));
    }
    public function edit(News $news){
        $newsCategories = $this->newsService->getAllNewsCategoryForNewsList();
        return view('panel.news.edit', compact('news','newsCategories'));
    }
    /**
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(News $news)
    {
        try{
            return view('panel.news.view', compact('news'));
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error(500, $ex);
        }
    }

    /**
     * @param NewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try{
            return Common\ResponseService::create($this->newsService->createNews($request->all()));
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error(Common\ResponseServiceInterface::STATUS_CODE_FLOW_ERROR_500,  $ex->getMessage());
        }
    }

    /**
     * @param NewsRequest $request
     * @param $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $news)
    {
        try{
            dd($news);
            return Common\ResponseService::success($this->newsService->updateNews($request->all(), $news));
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error('Something went wrong!');
        }
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
                return Common\ResponseService::success($result, 'News has been delete');
            }
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return  Common\ResponseService::error('Something went wrong!');
        }

    }
}
