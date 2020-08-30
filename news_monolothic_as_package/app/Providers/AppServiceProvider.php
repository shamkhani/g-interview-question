<?php

namespace App\Providers;

use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsCategoryRepositoryInterface;
use App\Repositories\NewsRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\TagRepositoryInterface;
use App\Services\Common\ResponseService;
use App\Services\Common\ResponseServiceInterface;
use App\Services\NewsService;
use App\Services\NewsServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
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
            NewsServiceInterface::class,
            NewsService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
