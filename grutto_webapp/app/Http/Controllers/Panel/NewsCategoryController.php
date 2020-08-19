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
class NewsCategoryController extends Controller
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

            return view('panel.news_category.index');

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
        return view('panel.news_category.new', compact('newsCategories'));
    }
    public function edit(News $news){
        $newsCategories = $this->newsService->getAllNewsCategoryForNewsList();
        return view('panel.news_category.edit', compact('news','newsCategories'));
    }
    /**
     * @param News $news
       */
    public function show(News $news)
    {
        try{
            return view('panel.news_category.edit', compact('news'));
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return redirect(route('news.create'))
                ->withErrors('There is a problem to show news');
        }
    }

    /**
     * @param NewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
//        try{
            $news = $this->newsService->createNews($request->all());
            return redirect(route('news.edit',['news'=>$news->id]))->with(['success'=>'News has been created']);
//        }catch (\Exception $ex){
//            Common\Logger::logError($ex);
//            return redirect(route('news.create'))
//            		->withInput($request->all())
//            		->withErrors($ex->getMessage());
//        }
    }

    /**
     * @param NewsRequest $request
     * @param $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $news)
    {
//        try{
            $data = $request->all();

            $news = $this->newsService->updateNews($data, $news);
            return redirect(route('news.edit',['news'=>$news->id]))->with(['success'=>'News has been updated']);
//        }catch (\Exception $ex){
//            Common\Logger::logError($ex);
//            return redirect(route('news.edit',['news'=>$news]))
//                ->withInput($request->all())
//                ->withErrors($request->validator);
//        }
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
                return redirect(route('news.index'))->with(['success'=>'News has been delete']);
            }
            return redirect(route('news.index'))->with(['error'=>'News can not delete! there is a problem']);
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return redirect('news.index')
                ->withErrors('News can not delete! there is a problem');
        }

    }
}
