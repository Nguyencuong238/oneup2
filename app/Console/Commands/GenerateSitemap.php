<?php
namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        // add bài viết
        $categories = DB::table('categories')
                ->where('type', 'post')
                ->orderBy('created_at', 'desc')
                ->get();

        $sitemap->addSitemap(config('app.url'). '/' . 'category-sitemap.xml', now()->format('Y-m-d H:i:s'));
        $sitemap->addSitemap(config('app.url'). '/' . 'post-sitemap.xml', now()->format('Y-m-d H:i:s'));
        $sitemap->addSitemap(config('app.url'). '/' . 'business-sitemap.xml', now()->format('Y-m-d H:i:s'));
        $content = $sitemap->render('sitemapindex');
        
        Storage::disk('public-1')->put('/sitemap-index.xml', $content->original);

        $sitemapC = App::make('sitemap');

        foreach ($categories as $c) {
                $sitemapC->add(route('postCategory', [$c->slug]), $c->created_at, '0.6', 'daily');
        }

        $sitemapC->store('xml', 'category-sitemap');
        if (File::exists(public_path() . '/category-sitemap.xml')) {
                chmod(public_path() . '/category-sitemap.xml', 0777);
        }

        $sitemapP = App::make('sitemap');

        $posts = DB::table('posts')
                ->orderBy('created_at', 'desc')
                ->get();

        foreach ($posts as $p) {
                $sitemapP->add(route('front.posts.show', [$p->slug]), $p->created_at, '0.6', 'daily');
        }

        $sitemapP->store('xml', 'post-sitemap');
        if (File::exists(public_path() . '/post-sitemap.xml')) {
                chmod(public_path() . '/post-sitemap.xml', 0777);
        }

        $sitemapb = App::make('sitemap');

        $posts = DB::table('projects')
                ->orderBy('created_at', 'desc')
                ->get();

        foreach ($posts as $p) {
                $sitemapb->add(route('front.projects.show', [$p->slug]), $p->created_at, '0.6', 'daily');
        }

        $sitemapb->store('xml', 'business-sitemap');
        if (File::exists(public_path() . '/business-sitemap.xml')) {
                chmod(public_path() . '/business-sitemap.xml', 0777);
        }

    }
}