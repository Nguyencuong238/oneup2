@extends('layouts.front')
@section('meta')
    <title>{{ $post->title }}</title>
    <link rel="canonical" href="{{ $post->showUrl() }}">
    <meta name="title" content="{{ $post->meta['meta_title'] ?? $post->title }}">
    <meta name="description" content="{{ $post->meta['meta_description'] ?? $post->excerpt }}">
    <meta name="keywords" content="Conggiao">
    <meta property="og:url" content="{{ $post->showUrl() }}">
    <meta property="og:title" content="{{ $post->meta['meta_title'] ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta['meta_title'] ?? $post->excerpt }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $post->getFirstMediaUrl('media') }}">
    <meta property="og:site_name" content="xaqueconggiao">
@stop
@push('css')
    <link rel="stylesheet" href="{{ asset('new/assets/style/jquery.magnific-popup.css') }}" type="text/css">
    <style>
        .jeg_post_title {
            padding: 5px 0;
        }
        .img-popup {
            cursor: zoom-in;
        }
    </style>
@endpush
@section('page')
    <div class="jeg_main">
        <div class="jeg_container">
            <div class="jeg_content jeg_singlepage">
                <div class="container">
                    <div class="jeg_ad jeg_article jnews_article_top_ads">
                        <div class="ads-wrapper"></div>
                    </div>
                    <div class="row">
                        <div class="jeg_main_content col-md-8">
                            <div class="jeg_inner_content">
                                <div class="jeg_breadcrumbs jeg_breadcrumb_container">
                                    <div id="breadcrumbs"><span class="">
                                       <a href="{{ route('home') }}">Trang Chủ</a>
                                           </span><i class="fa fa-angle-right"></i><span class="">
                                           <a href="{{ $post->showUrl() }}">{{ $post->title }}</a>
                                       </span>
                                    </div>
                                </div>
                                <div class="entry-header">
                                    <h1 class="jeg_post_title">{{ $post->title }}</h1>
                                    <div class="jeg_meta_container">
                                        <div class="jeg_post_meta jeg_post_meta_1">
                                            <div class="meta_left">
                                                {{--  <div class="jeg_meta_author">
                                                    <span class="meta_text">Đăng bởi</span>
                                                    <a href="{{ $post->showUrl() }}">{{$post->author->name}}</a>
                                                </div>  --}}
                                                @if(auth()->check())
                                                    @if(auth()->user()->isAdmin())
                                                    <div class="jeg_meta_author">
                                                        <a target="_blank" href="{{ route('posts.edit', $post->id) }}">SỬA BÀI</a>
                                                    </div>
                                                    @endif
                                                @endif
                                                <div class="jeg_meta_date">
                                                    <a href="{{ $post->showUrl() }}">
                                                        <i class="fa fa-clock-o me-1"></i>
                                                        {{ $post->created_at->format('d/m/Y H:i:s') }}
                                                    </a>
                                                </div>
                                                <div class="jeg_meta_category">
                                                    <span><span class="meta_text">Chuyên mục:</span>
                                                        <a href="{{ $post->showUrl() }}" rel="category tag">{{ $post->title }}</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jeg_share_top_container">
                                    <div class="jeg_share_button clearfix">
                                        <div class="jeg_share_stats">
                                            <div class="jeg_share_count">
                                                <div class="counts">0</div>
                                                <span class="sharetext">SHARES</span>
                                            </div>
                                            <div class="jeg_views_count">
                                                <div class="counts">{{ $post->views }}</div>
                                                <span class="sharetext">VIEWS</span>
                                            </div>
                                        </div>
                                        <div class="jeg_sharelist">
                                            <a href="http://www.facebook.com/sharer.php?u={{ $post->showUrl() }}" rel="nofollow" class="jeg_btn-facebook expanded"><i class="fa fa-facebook-official"></i><span>Share on Facebook</span></a><a href="https://twitter.com/intent/tweet?text={{ $post->title }};url={{ $post->showUrl() }}" rel="nofollow" class="jeg_btn-twitter expanded"><i class="fa fa-twitter"></i><span>Share on Twitter</span></a><a href="https://www.pinterest.com/pin/create/bookmarklet/?pinFave=1&amp;url={{ $post->showUrl() }};" rel="nofollow" class="jeg_btn-pinterest "><i class="fa fa-pinterest"></i></a>
                                            <div class="share-secondary">
                                                <a href="https://plus.google.com/share?url={{ $post->showUrl() }}" rel="nofollow" class="jeg_btn-google-plus removed "><i class="fa fa-google-plus"></i></a><a href="https://www.linkedin.com/shareArticle?url={{ $post->showUrl() }};title={{ $post->title }}" rel="nofollow" class="jeg_btn-linkedin "><i class="fa fa-linkedin"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="entry-content no-share" style="transform: none;">
                                    <div class="content-inner">
                                        {!! $post->body !!}
                                    </div>
                                </div>
                                <div class="jnews_related_post_container">
                                    @if(isset($otherPost))
                                    <div class="jeg_postblock_22 jeg_postblock jeg_module_hook jeg_pagination_disable jeg_col_2o3 jnews_module_11102_0_632189454874f   " data-unique="jnews_module_11102_0_632189454874f">
                                        <div class="jeg_block_heading jeg_block_heading_6 jeg_subcat_right">
                                            <h3 class="jeg_block_title"><span>BÀI VIẾT<strong>LIÊN QUAN</strong></span></h3>
                                        </div>
                                        <div class="jeg_block_container">
                                            <div class="jeg_posts_wrap">
                                                <div class="jeg_posts jeg_load_more_flag">
                                                    @foreach($otherPost as $Opost)
                                                        <article class="jeg_post jeg_pl_md_5 format-standard">
                                                        <div class="jeg_thumb">
                                                            <a href="{{ $Opost->showUrl() }}">
                                                                <div class="thumbnail-container animate-lazy  size-715 ">
                                                                    <img width="350" height="250"
                                                                         src="{{ $Opost->getFirstMediaUrl('media', 'show') }}"
                                                                         class="attachment-jnews-350x250 size-jnews-350x250 lazyload wp-post-image"
                                                                         alt="{{ $Opost->title }}" loading="lazy" sizes="(max-width: 350px) 100vw, 350px"
                                                                         data-sizes="auto" data-expand="700"></div>
                                                            </a>
                                                            {{--  <div class="jeg_post_category">
                                                                <span>
                                                                    <a href="{{ $Opost->showUrl() }}" class="category">
                                                                        {{ $Opost->title }}
                                                                    </a>
                                                                </span>
                                                            </div>  --}}
                                                        </div>
                                                        <div class="jeg_postblock_content">
                                                            <h3 class="jeg_post_title">
                                                                <a href="{{ $Opost->showUrl() }}" class="text-3-line">{{ $Opost->title }}</a>
                                                            </h3>
                                                            <div class="jeg_post_meta">
                                                                <div class="jeg_meta_date">
                                                                    <a href="{{ $Opost->showUrl() }}">
                                                                        <i class="fa fa-clock-o me-1"></i>
                                                                        {{ $Opost->created_at->format('d/m/Y H:i:s') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @include('front.posts._rightSidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom-js')
    <script src="{{ asset('new/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script>
        var img = $(".content-inner img[loading=lazy]");
        if (img.length) {
            img.each(function() {
                $(this).wrap('<a class="img-popup d-block" href="' + $(this).attr('src') +'">');
            })
            
            $('.img-popup').magnificPopup({
                type: "image",
                closeOnContentClick: true,
                closeBtnInside: false,
                gallery: {
                    enabled: true,
                },
            });
        }
    </script>
@endsection
