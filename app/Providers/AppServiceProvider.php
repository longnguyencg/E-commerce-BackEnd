<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CategoryServiceInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\CommentServiceInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\CustomerServiceInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductServiceInterface;
use App\Interfaces\VoteRepositoryInterface;
use App\Interfaces\VoteServiceInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\VoteRepository;
use App\Services\CategoryService;
use App\Services\CommentService;
use App\Services\CustomerService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\VoteService;
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
        $this->app->singleton(VoteRepositoryInterface::class, VoteRepository::class);
        $this->app->singleton(VoteServiceInterface::class, VoteService::class);
        $this->app->singleton(CategoryServiceInterface::class, CategoryService::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(CustomerServiceInterface::class, CustomerService::class);
        $this->app->singleton(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->singleton(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
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
