<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Console\Command;

class ReplaceDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'replace:domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $blogs = Blog::get();

        foreach($blogs as $blog) {
            $blog->body = str_replace("xaqueconggiao.com","didanconggiao.com",$blog->body);
            $blog->save();
        }

        $posts = Post::get();

        foreach($posts as $post) {
            $post->body = str_replace("xaqueconggiao.com","didanconggiao.com",$post->body);
            $post->save();
        }

        
    }
}
