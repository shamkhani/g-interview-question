<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsEditRequest;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Resources\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
       */
    public function show(News $news)
    {
        try{
            return view('panel.news.edit', compact('news'));
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return redirect()->back()
                ->with(['error'=>$ex->getMessage()]);
        }
    }

    /**
     * @param NewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try{

            $news = $this->newsService->createNews($request->all());
            if($news){
                $request->file('feature_image')->store();
            }
            $tags = $request->get('tags');
            if($tags){
                $news->tags()->createMany(explode(',',$tags));
            }
            return redirect(route('news.edit',['news'=>$news->id]))->with(['success'=>'News has been created']);
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
              return redirect()->back()
            		->withInput($request->all())
            		->with(['error'=>$ex->getMessage()]);
        }
    }

    /**
     * @param NewsEditRequest $request
     * @param $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsEditRequest $request, $news)
    {
        try{
            $data = $request->all();
            if($request->get('feature_image') == null){
                unset($data['feature_image']);
            }else{
                // TODO We can unlink old file
                  $request->file('feature_image')->store(storage_path('images'));
            }

            $news = $this->newsService->updateNews($data, $news);
            $tags = $request->get('tags');
            if($tags){
                $news->tags()->createMany(explode(',',$tags));
            }
            if($news) {
                return redirect()->back()->with(['success' => 'News has been updated']);
            }else {
                return redirect()->back()->with(['error' => 'There is an error to upate news']);
            }

        }catch (\Exception $ex){
            Common\Logger::logError($ex);
               return redirect()->back()
            		->withInput($request->all())
            		->with(['error'=>$ex->getMessage()]);
        }
        catch (ModelNotFoundException $ex){
            Common\Logger::logError($ex);
            return redirect()->back()
                ->withInput($request->all())
                ->with(['error'=>$ex->getMessage()]);
        }
    }


    public function getNewsByCategoryId(Request $request, $cid, $slug)
    {
        return view('panel.news.by_category',compact('cid','slug'));
    }

}
