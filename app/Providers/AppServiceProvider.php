<?php

namespace App\Providers;

use App\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Model::unguard();
        Relation::enforceMorphMap([
            'post'    => 'App\Models\Post',
            'page'    => 'App\Models\Page',
            'user'    => 'App\Models\User',
            'tempo'   => 'Spatie\MediaLibraryPro\Models\TemporaryUpload',
            'category'   => 'App\Models\Category',
        ]);
    }
}
