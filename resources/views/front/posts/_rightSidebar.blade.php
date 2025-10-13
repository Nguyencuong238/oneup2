<div class="jeg_sidebar left jeg_sticky_sidebar col-lg-4 ps-lg-4" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
    <div class="jegStickyHolder">
        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;">
            <div class="widget widget_jnews_popular" id="jnews_popular-3">
                <div class="jeg_block_heading jeg_block_heading_6 jnews_module_11285_0_6321863940580">
                    <h3 class="jeg_block_title"><span>BÀI VIẾT<strong>NỔI BẬT</strong></span></h3>
                </div>
                <ul class="popularpost_list">
                    @php $postFeature = \App\Models\Post::with('media')->latest()->first(); @endphp
                    <li class="popularpost_item format-standard">
                        <div class="jeg_thumb">
                            <a href="{{ $postFeature->showUrl() }}">
                                <img src="{{ $postFeature->getFirstMediaUrl('media') }}" class="w-100 " alt="{{ $postFeature->title }}">
                            </a>
                        </div>
                        <h3 class="jeg_post_title">
                            <a href="{{ $postFeature->showUrl() }}" data-num="01">{{ $postFeature->title }}</a>
                        </h3>
                        <div class="popularpost_meta">
                            <div class="jeg_socialshare">
                                <span class="share_count"><i class="fa fa-share-alt"></i> 0 shares</span>
                                <div class="socialshare_list">
                                    <a href="http://www.facebook.com/sharer.php?u={{ $postFeature->showUrl() }}" class="jeg_share_fb">
                                        <span class="share-text">Share</span>
                                        <span class="share-count">0</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    @php $key = 1; @endphp
                    @foreach(\App\Models\Post::with('media')->latest()->take(5)->get() as $l)
                        @if($loop->index > 0)
                            @php $key++; @endphp
                            <li class="popularpost_item format-standard">
                                <h3 class="jeg_post_title">
                                    <a href="{{ $l->showUrl() }}" data-num="0{{ $key }}">
                                        {{ $l->title }}
                                    </a>
                                </h3>
                                <div class="popularpost_meta">
                                    <div class="jeg_socialshare">
                                        <span class="share_count"><i class="fa fa-share-alt"></i> 0 shares</span>
                                        <div class="socialshare_list">
                                            <a href="http://www.facebook.com/sharer.php?u={{ $l->showUrl() }}" class="jeg_share_fb">
                                                <span class="share-text">Share</span>
                                                <span class="share-count">0</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="widget widget_jnews_module_block_4" id="jnews_module_block_4-2">
                <div class="jeg_postblock_4 jeg_postblock jeg_module_hook jeg_pagination_disable jeg_col_1o3 jnews_module_11285_1_63218639448e6  normal " data-unique="jnews_module_11285_1_63218639448e6">
                    <div class="jeg_block_heading jeg_block_heading_6 jeg_subcat_right">
                        <h3 class="jeg_block_title"><span>BÀI VIẾT<strong>MỚI NHẤT</strong></span></h3>
                    </div>
                    <div class="jeg_posts jeg_block_container">
                        <div class="jeg_posts jeg_load_more_flag row">
                            @foreach(\App\Models\Post::with('media')->latest()->take(5)->get() as $l)
                            <div class="col-lg-12 col-sm-6">
                                <article class="jeg_post jeg_pl_md_3 format-standard row mb-4">
                                    <div class="jeg_postblock_content col-lg-7 pe-lg-2 news-post__title">
                                        <h3 class="jeg_post_title">
                                            <a href="{{ $l->showUrl() }}">{{ $l->title }}</a>
                                        </h3>
                                        <div class="jeg_post_meta">
                                            {{--  <div class="jeg_meta_author"><span class="by">Đăng bởi</span> <a href="{{ $l->showUrl() }}">Admin</a></div>  --}}
                                            <div class="jeg_meta_date">
                                                <a href="{{ $l->showUrl() }}">
                                                    <i class="fa fa-clock-o me-1"></i>
                                                    {{ $l->created_at->format('d/m/Y H:i:s') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="jeg_post_excerpt d-none">
                                            <p>
                                                {{ $l->title }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 ps-lg-2">
                                        <a href="{{ $l->showUrl() }}">
                                            <img src="{{ $l->getFirstMediaUrl('media', 'show') }}" class="w-100 widget_img" alt="{{ $l->title }}">
                                        </a>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget widget_jnews_module_block_4" id="jnews_module_block_4-2">
                <div class="jeg_postblock_4 jeg_postblock jeg_module_hook jeg_pagination_disable jeg_col_1o3 jnews_module_11285_1_63218639448e6  normal " data-unique="jnews_module_11285_1_63218639448e6">
                    <div class="jeg_block_heading jeg_block_heading_6 jeg_subcat_right">
                        <h3 class="jeg_block_title text-uppercase"><span>Thông báo <strong>Xa Quê</strong></span></h3>
                    </div>
                    <div class="jeg_posts jeg_block_container">
                        <div class="jeg_posts jeg_load_more_flag row">
                            @php
                                $postXaQue = \App\Models\Post::with('media')
                                    ->latest()
                                    ->whereHas('categories', function ($q) {
                                        $q->where('slug', 'thong-bao-xa-que');
                                    })
                                    ->take(5)
                                    ->get();
                            @endphp
                            @foreach($postXaQue as $item)
                            <div class="col-lg-12 col-sm-6">
                                <article class="jeg_post jeg_pl_md_3 format-standard row mb-4">
                                    <div class="jeg_postblock_content col-lg-7 pe-lg-2 news-post__title">
                                        <h3 class="jeg_post_title">
                                            <a href="{{ $item->showUrl() }}">{{ $item->title }}</a>
                                        </h3>
                                        <div class="jeg_post_meta">
                                            <div class="jeg_meta_date">
                                                <a href="{{ $item->showUrl() }}">
                                                    <i class="fa fa-clock-o me-1"></i>
                                                    {{ $item->created_at->format('d/m/Y H:i:s') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="jeg_post_excerpt d-none">
                                            <p>
                                                {{ $item->title }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 ps-lg-2">
                                        <a href="{{ $item->showUrl() }}">
                                            <img src="{{ $item->getFirstMediaUrl('media', 'show') }}" class="w-100 widget_img" alt="{{ $item->title }}">
                                        </a>
                                    </div>
                                </article>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('css')
<style>
   
    .popularpost_list img {
        height: 220px;
    }
    .popularpost_item:first-child .jeg_post_title {
        font-size: 16px;
        line-height: 1.5;
    }
    .popularpost_item .jeg_post_title {
        line-height: 1.5;
    }
    .widget_img {
        height: 100px;
    }
    @media (max-width: 1199px) {
        .cate-img__small {
            height: 215px;
        }
        
        .widget_img {
            height: 85px;
        }
    }
    @media (max-width: 991px) {
        .popularpost_list img {
            height: 420px;
        }
        .widget_img {
            height: 210px;
        }
        .news-post__title {
            order: 1;
            margin-top: 8px;
        }
    }
    @media (max-width: 767px) {
        .widget_img {
            height: 185px;
        }
       
        .popularpost_list img {
            height: 340px;
        }
    }

    @media (max-width: 575px) {
        .widget_img, .popularpost_list img {
            height: 240px;
        }
        .popularpost_item:first-child .jeg_post_title {
            font-size: 14px;
        }
    }

    @media (max-width: 375px) {
        .widget_img, .popularpost_list img {
            height: 230px;
        }
    }
</style>
@endpush