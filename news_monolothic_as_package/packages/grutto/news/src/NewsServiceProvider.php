<?php

namespace Grutto\News;

use  Grutto\News\Controllers\Middleware\ActiveCustomCacheMiddleware;
use Grutto\News\Repositories\NewsCategoryRepository;
use Grutto\News\Repositories\NewsCategoryRepositoryInterface;
use Grutto\News\Repositories\NewsRepository;
use Grutto\News\Repositories\NewsRepositoryInterface;
use Grutto\News\Repositories\TagRepository;
use Grutto\News\Repositories\TagRepositoryInterface;
use Grutto\News\Services\Common\ResponseService;
use Grutto\News\Services\Common\ResponseServiceInterface;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Grutto\News\Services;
class NewsServiceProvider extends ServiceProvider
{
   /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(
            ResponseServiceInterface::class,
            ResponseService::class
        );

        $this->app->singleton(
            NewsRepositoryInterface::class,
            NewsRepository::class);

        $this->app->singleton(
            NewsCategoryRepositoryInterface::class,
            NewsCategoryRepository::class);

        $this->app->singleton(
            TagRepositoryInterface::class,
            TagRepository::class);


        $this->app->singleton(
            Services\NewsServiceInterface::class,
            Services\NewsService::class);

    }

    /**
     * Bootstrap services.
     *
     *
     * @return void
     */
    public function boot()
    {

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('custom_cache', ActiveCustomCacheMiddleware::class);

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->loadViewsFrom(__DIR__.'/views', 'news');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/grutto/news'),
        ]);
    }
}
