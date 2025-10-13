@extends('layouts.front')

@section('meta')
        <title>Đối tác</title>
        <link rel="canonical" href="{{ request()->url() }}">
        <meta name="title" content="Xa quê công giáo">
        <meta name="description" content="Xa quê công giáo">
        <meta name="keywords" content="Xa quê công giáo">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:title" content="Xa quê công giáo">
        <meta property="og:description" content="Xa quê công giáo">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('/images/news-01.png') }}">
        <meta property="og:site_name" content="Xa quê công giáo">
@stop

@push('css')
<style>
    header.vs-header.header-layout5 {
        padding-bottom: 0;
        background-color: ;
    }
    .header-layout5 .menu-area, .sticky-wrapper, button.icon-btn.style4 {
        background-color: var(--title-color);
    }
    .will-sticky .sticky-active.active, .will-sticky .menu-area, .will-sticky .icon-btn.style4 {
        background-color: #000;
    }
    .icon-btn.style4 {
        font-size: 28px;
    }
    .menu-style3 > ul > li > a {
        padding: 50px 0;
        color: #fff;
    }
</style>
@endpush
@section('page')
    <div class="breadcumb-wrapper">
        <div class="parallax" data-bg-class="bg-title" data-parallax-image="assets/img/breadcumb/breadcrumb-bg.jpg"></div>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li class="active">Đối tác</li>
                    </ul>
                </div>
                <h1 class="breadcumb-title">Đối tác</h1>
            </div>
        </div>
    </div>
    <section class="vs-brand-wrapper space-bottom bg-dark">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-4">
                    <div class="title-area text-center text-xl-start mb-xl-0">
                        <span class="sub-title">#Top Ranking Legends</span>
                        <h2 class="sec-title text-white">Brands weve collaborated</h2>
                        <h2 class="sec-title-style2">with team.</h2>
                        <div class="sec-shape">
                            <div class="sec-shape_bar"></div>
                            <div class="sec-shape_bar"></div>
                            <div class="sec-shape_bar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="mb-40">
                        <div class="row justify-content-center justify-content-md-between align-items-center gy-4 text-center">
                            <div class="col-4 col-md-auto">
                                <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-1.png')}}" alt="Brand Image" /></div>
                            </div>
                            <div class="col-4 col-md-auto">
                                <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-2.png')}}" alt="Brand Image" /></div>
                            </div>
                            <div class="col-4 col-md-auto">
                                <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-3.png')}}" alt="Brand Image" /></div>
                            </div>
                            <div class="col-4 col-md-auto">
                                <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-4.png')}}" alt="Brand Image" /></div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center justify-content-md-between align-items-center gy-4 text-center">
                        <div class="col-4 col-md-auto">
                            <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-5.png')}}" alt="Brand Image" /></div>
                        </div>
                        <div class="col-4 col-md-auto">
                            <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-6.png')}}" alt="Brand Image" /></div>
                        </div>
                        <div class="col-4 col-md-auto">
                            <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-7.png')}}" alt="Brand Image" /></div>
                        </div>
                        <div class="col-4 col-md-auto">
                            <div class="vs-brand"><img src="{{asset('assets/img/brand/brand-8.png')}}" alt="Brand Image" /></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop