<?php

namespace App\Providers;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\ServiceProvider;
use App\FormFields\CloudinaryImageFormField;
use App\Models\Task;
use App\Observers\TaskObserver;
use App\Models\Advice;
use App\Observers\AdviceObserver;
use App\Models\Banner;
use App\Observers\BannerObserver;
use App\Models\Sale;
use App\Observers\SaleObserver;
use App\Models\Products;
use App\Observers\ProductsObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addFormField(CloudinaryImageFormField::class);
        Task::observe(TaskObserver::class);
        Advice::observe(AdviceObserver::class);
        Banner::observe(BannerObserver::class);
        Sale::observe(SaleObserver::class);
        Products::observe(ProductsObserver::class);
    }
}
