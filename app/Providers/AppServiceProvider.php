<?php

namespace App\Providers;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\CommentServiceInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductServiceInterface;
use App\Repositories\CommentRepository;
use App\Repositories\ProductRepository;
use App\Services\CommentService;
use App\Services\ProductService;
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
        $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(ProductServiceInterface::class, ProductService::class);
        $this->app->singleton(CommentServiceInterface::class, CommentService::class);
        $this->app->singleton(CommentRepositoryInterface::class, CommentRepository::class);
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
