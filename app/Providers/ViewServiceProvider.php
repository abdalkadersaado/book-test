<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!request()->is('admin/*')) {
            Paginator::defaultView('vendor.pagination.boighor');

            view()->composer('*', function ($view) {
                $dir_lang = config('app.locale') == 'ar' ? 'rtl' : 'ltr';
                $view->with([
                    'dir_lang' => $dir_lang,

                ]);
            });
        }

        if (request()->is('admin/*')) {

            view()->composer('*', function ($view) {

                if (!Cache::has('admin_side_menu')) {
                    Cache::forever('admin_side_menu', Permission::tree());
                }
                $admin_side_menu = Cache::get('admin_side_menu');

                $view->with([
                    'admin_side_menu' => $admin_side_menu,
                ]);
            });
        }
    }
}
