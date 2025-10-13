<?php

namespace App\Listener;

use App\Events\PostView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Session\Store;

class PostViewHandler
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostView  $event
     * @return void
     */
    public function handle(PostView $event)
    {
        $post = $event->post;

        if (!$this->isPostViewed($post))
	    {
	        $post->increment('views');
	        $this->storePost($post);
	    }
    }

    private function isPostViewed($post)
	{
	    $viewed = $this->session->get('viewed_posts', []);

	    return array_key_exists($post->id, $viewed);
	}

	private function storePost($post)
	{
	    $key = 'viewed_posts.' . $post->id;

	    $this->session->put($key, time());
	}
}
