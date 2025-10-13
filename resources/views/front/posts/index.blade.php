@extends('layouts.front')
@section('meta')
    @if(request()->routeIs('postCategory'))
        <title>{{ $category->name }}</title>
        <link rel="canonical" href="{{ request()->url() }}">
        <meta name="title" content="{{ $category->meta['meta_title'] ?? $category->name }}">
        <meta name="description" content="{{ $category->meta['meta_description'] ?? 'Xa quê công giáo' }}">
        <meta name="keywords" content="conggiao">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="{{ $category->meta['meta_title'] ?? $category->name }}">
        <meta property="og:description" content="{{ $category->meta['meta_description'] ?? 'Xa quê công giáo' }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
        <meta property="og:site_name" content="xaqueconggiao">
    @elseif(request()->routeIs('postTag'))
        <title>Thẻ - {{ $tag->name }}</title>
        <link rel="canonical" href="{{ request()->url() }}">
        <meta name="title" content="Thẻ - {{ $tag->name }}">
        <meta name="description" content="Công Giáo">
        <meta name="keywords" content="Conggiao">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="Xa quê công giáo">
        <meta property="og:description" content="Xa quê công giáo">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
        <meta property="og:site_name" content="Xa quê công giáo">
    @elseif(request()->routeIs('postArchive'))
        <title>Bài viết tháng {{ request('month') }} - {{ request('year') }}</title>
        <link rel="canonical" href="{{ request()->url() }}">
        <meta name="title" content="Conggiao">
        <meta name="description" content="Công Giáo">
        <meta name="keywords" content="Conggiao">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="Conggiao">
        <meta property="og:description" content="Conggiao">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
        <meta property="og:site_name" content="xaqueconggiao">
    @else
        <title>Bài viết</title>
        <link rel="canonical" href="{{ request()->url() }}">
        <meta name="title" content="Conggiao">
        <meta name="description" content="Công Giáo">
        <meta name="keywords" content="Conggiao">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="Conggiao">
        <meta property="og:description" content="Conggiao">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
        <meta property="og:site_name" content="xaqueconggiao">p
    @endif
@stop
@push('css')
<style>
    .cate-img__big {
        height: 460px;
    }
    .cate-img__small {
        height: 250px;
    }
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
        .cate-img__big {
            height: 430px;
        }
        .widget_img {
            height: 85px;
        }
    }
    @media (max-width: 991px) {
        .cate-img__small {
            
        }
        .cate-img__big {
            
        }
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
        .cate-img__small, .widget_img {
            height: 185px;
        }
        .cate-img__big {
            height: 360px;
        }
        .popularpost_list img {
            height: 340px;
        }
    }

    @media (max-width: 575px) {
        .cate-img__small, .widget_img, .popularpost_list img {
            height: 240px;
        }
        .popularpost_item:first-child .jeg_post_title {
            font-size: 14px;
        }
    }

    @media (max-width: 375px) {
        .cate-img__small, .widget_img, .popularpost_list img {
            height: 230px;
        }
    }
</style>
@endpush
@section('page')
    <div class="jeg_main">
        <div class="jeg_container">
            <div class="jeg_content">
                <div class="jnews_category_header_top">
                </div>
                <div class="jeg_section">
                    <div class="container">
                        <div class="jeg_ad jeg_category jnews_archive_above_hero_ads">
                            <div class="ads-wrapper"></div>
                        </div>
                        <div class="jnews_category_hero_container">
                        </div>
                        <div class="jeg_ad jeg_category jnews_archive_below_hero_ads">
                            <div class="ads-wrapper"></div>
                        </div>
                        <div class="jeg_cat_content row">
                            <div class="jeg_main_content jeg_column col-lg-8">
                                <div class="jeg_inner_content">
                                    <div class="jnews_category_header_bottom">
                                        <div class="jeg_cat_header jeg_cat_header_1">
                                            <div class="jeg_breadcrumbs jeg_breadcrumb_category jeg_breadcrumb_container">
                                                <div id="breadcrumbs">
                                                    <span class="">
                                                        <a href="{{ route('home') }}">TRANG CHỦ</a>
                                                    </span>
                                                    @if(isset($category))
                                                        <i class="fa fa-angle-right"></i>
                                                        <span class="">
                                                            <a href="{{ request()->url() }}">{{ Str::ucfirst($category->name) }}</a>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(isset($category))
                                                <h1 class="jeg_cat_title">{{ Str::ucfirst($category->name) }}</h1>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="jnews_category_content_wrapper">
                                        <div class="jeg_postblock_14 jeg_postblock jeg_module_hook jeg_pagination_nav_1 jeg_col_2o3">
                                            <div class="jeg_block_container">
                                                <div class="jeg_posts_wrap">
                                                    @if($posts->count() > 0)
                                                    @php
                                                        $first_post = $posts->first();
                                                    @endphp
                                                    <div class="jeg_postbig">
                                                        <article class="jeg_post jeg_pl_lg_box format-standard d-sm-block d-none">
                                                            <div class="box_wrap">
                                                                <div class="jeg_thumb">
                                                                    <a href="{{ $first_post->showUrl() }}">
                                                                        <img src="{{ $first_post->getFirstMediaUrl('media') }}" class="w-100 cate-img__big" alt="{{ $first_post->title }}">
                                                                    </a>
                                                                </div>
                                                                <div class="jeg_postblock_content">
                                                                    @if(isset($category))
                                                                        <div class="jeg_post_category">
                                                                            <span>
                                                                                <a href="{{ request()->url() }}"
                                                                                     class="category">
                                                                                    {{ $category->name }}
                                                                                </a>
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                    <h3 class="jeg_post_title">
                                                                        <a href="{{ $first_post->showUrl() }}">{{ $first_post->title }}</a>
                                                                    </h3>
                                                                    <div class="jeg_post_meta">
                                                                        {{--  <div class="jeg_meta_author"><span class="by">Đăng bởi</span> <a href="{{ $first_post->showUrl() }}">admin</a></div>  --}}
                                                                        <div class="jeg_meta_date">
                                                                            <a href="{{ $first_post->showUrl() }}">
                                                                                <i class="fa fa-clock-o me-1"></i>
                                                                                {{ $first_post->created_at->format('d/m/Y H:i:s') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                        <article class="jeg_post jeg_pl_md_1 format-standard d-sm-none d-block">
                                                            <div class="jeg_thumb">
                                                                <a href="{{ $first_post->showUrl() }}">
                                                                    <img src="{{ $first_post->getFirstMediaUrl('media') }}" class="w-100 cate-img__small" alt="{{ $first_post->title }}">
                                                                </a>
                                                                @if(isset($category))
                                                                    <div class="jeg_post_category">
                                                                        <span>
                                                                            <a href="{{ request()->url() }}"
                                                                               class="category">
                                                                                {{ $category->name }}
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="jeg_postblock_content">
                                                                <h3 class="jeg_post_title">
                                                                    <a href="{{ $first_post->showUrl() }}">{{ $first_post->title }}</a>
                                                                </h3>
                                                                <div class="jeg_post_meta">
                                                                    {{--  <div class="jeg_meta_author"><span class="by">Đăng bởi</span> <a href="{{ $first_post->showUrl() }}">Admin</a></div>  --}}
                                                                    <div class="jeg_meta_date">
                                                                        <a href="{{ $first_post->showUrl() }}">
                                                                            <i class="fa fa-clock-o me-1"></i>
                                                                            {{ $first_post->created_at->format('d/m/Y H:i:s') }}
                                                                        </a></div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </div>
                                                    @endif

                                                    @if(isset($posts))
                                                    <div class="jeg_posts jeg_load_more_flag">
                                                        @foreach($posts as $post)
                                                            @if($loop->index > 0)
                                                            <article class="jeg_post jeg_pl_md_1 format-standard">
                                                                <div class="jeg_thumb">
                                                                    <a href="{{ $post->showUrl() }}">
                                                                        <img src="{{ $post->getFirstMediaUrl('media') }}" class="w-100 cate-img__small" alt="{{ $post->title }}">
                                                                    </a>
                                                                    @if(isset($category))
                                                                        <div class="jeg_post_category">
                                                                            <span>
                                                                                <a href="{{ request()->url() }}"
                                                                                   class="category">
                                                                                    {{ $category->name }}
                                                                                </a>
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="jeg_postblock_content">
                                                                    <h3 class="jeg_post_title">
                                                                        <a href="{{ $post->showUrl() }}">{{ $post->title }}</a>
                                                                    </h3>
                                                                    <div class="jeg_post_meta">
                                                                        {{--  <div class="jeg_meta_author"><span class="by">Đăng bởi</span> <a href="{{ $post->showUrl() }}">{{ $post->author->name }}</a></div>  --}}
                                                                        <div class="jeg_meta_date">
                                                                            <a href="{{ $post->showUrl() }}">
                                                                                <i class="fa fa-clock-o me-1"></i>
                                                                                {{ $post->created_at->format('d/m/Y H:i:s') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="jeg_block_navigation">
                                                {{ $posts->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('front.posts._rightSidebar')
                        </div>
                    </div>
                </div>
            </div>
            <div class="jeg_ad jnews_above_footer_ads">
                <div class="ads-wrapper"></div>
            </div>
        </div>
    </div>
@stop
