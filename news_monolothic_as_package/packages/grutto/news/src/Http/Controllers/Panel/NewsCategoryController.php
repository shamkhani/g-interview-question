<?php

namespace Grutto\News\Controllers\Panel;

use Grutto\News\Controllers\Controller;
use Grutto\News\Requests\NewsCategoryEditRequest;
use Grutto\News\Requests\NewsCategoryRequest;
use Grutto\News\Requests\NewsCategoryRequestRequest;
use Grutto\News\\NewsCategory;
use Grutto\News\\NewsResource;
use App\Services\Common;
use App\Services\NewsServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class NewsController
 * @package Grutto\News\Controllers
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
        try{
            return view('panel.news_category.index');

        }catch (\Exception $ex){
            Common\Logger::logError($ex);
           return redirect()->back()
            		->withInput($request->all())
            		->with(['error'=>$ex->getMessage()]);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $newsCategories = $this->newsService->getAllNewsCategoryForNewsList();
        return view('panel.news_category.new', compact('newsCategories'));
    }
    public function edit(NewsCategory $category){
        $newsCategories = $this->newsService->getAllNewsCategoryForNewsList();
        return view('panel.news_category.edit', compact('category','newsCategories'));
    }
    /**
     * @param NewsCategory $category
       */
    public function show(NewsCategory $category)
    {
        try{
            return view('panel.news_category.edit', compact('category'));
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return redirect()->back()
            		->with(['error'=>$ex->getMessage()]);
        }
    }

    /**
     * @param NewsCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCategoryRequest $request)
    {
        try{
            $category = $this->newsService->createNewsCategory($request->all());
            return redirect(route('categories.edit',['category'=>$category->id]))->with(['success'=>'News category has been created']);
        }catch (\Exception $ex){
            Common\Logger::logError($ex);
            return redirect()->back()
            		->withInput($request->all())
            		->with(['error'=>$ex->getMessage()]);
        }
    }

    /**
     * @param NewsCategoryEditRequest $request
     * @param $category
     * @return \Illuminate\Http\Response
     */
    public function update(NewsCategoryEditRequest $request, $category)
    {
        try{
            $data = $request->all();
            $category = $this->newsService->updateNewsCategory($data, $category);
            return redirect()->back()->with(['success'=>'NewsCategory has been updated']);
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


}
