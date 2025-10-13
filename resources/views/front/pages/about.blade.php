@extends('layouts.front')

@section('meta')
        <title>Giới thiệu</title>
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
                        <li><a href="/">Trang chủ</a></li>
                        <li class="active">Giới thiệu</li>
                    </ul>
                </div>
                <h1 class="breadcumb-title">Giới thiệu</h1>
            </div>
        </div>
    </div>
    <section class="vs-about-wrapper space-top">
        <div class="container z-index-common">
            <div class="row align-items-center flex-row-reverse justify-content-between">
                <div class="col-lg-6 mb-15 me-xxl-5 mb-30">
                    <div class="stream-video-slide">
                        <img src="{{ asset('assets/img/about/about-image.jpg') }}" alt="About Image" class="w-100" />
                        {{--  <a href="#" class="play-btn style3"><i class="fas fa-play"></i></a>  --}}
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-4 mb-30">
                    <div class="about-content ps-xxl-3 ps-xxl-5">
                        <span class="sub-title text-title">#Giới thiệu</span>
                        <h2 class="sec-title">VỀ CHÚNG TÔI</h2>
                        <div class="sec-shape">
                            <div class="sec-shape_bar"></div>
                            <div class="sec-shape_bar"></div>
                            <div class="sec-shape_bar"></div>
                        </div>
                        <p class="sec-text mt-4 pt-2"></p>
                        <div class="arrow-list mb-4 pb-2">
                            <ul>
                                <li><i class="fal fa-arrow-circle-right"></i>Dragon Game là một trong những dự án cộng nghệ nổi bật và trọng tâm của Tập Đoàn Công Nghệ AnyTech. Được hình thành và phát triển từ năm 01/2021, Dragon Game định vị đến năm 2023 trở thành một Hệ sinh thái hỗ trợ Game Blockchain hàng đầu Châu Á.</li>
                                <li><i class="fal fa-arrow-circle-right"></i>Hiện tại, DragonNews đã liên kết hoạt động tại 10 quốc gia trong khu vực Đông Nam Á, chúng tôi mang đến giá trị và cơ hội kinh doanh thông qua những giải pháp và sản phẩm công nghệ blockchain và gameblokchain chất lượng nhất.</li>
                                <li><i class="fal fa-arrow-circle-right"></i>Bên cạnh đó, DragonNews hướng với việc trở thành một Quỹ đầu tư với mục tiêu ươm mầm, hỗ trợ  cho các các dự án Startup về GameBlockchain trong và ngoài nước.</li>
                                <li><i class="fal fa-arrow-circle-right"></i>Đội ngũ sáng lập giàu kinh nghệm cùng các đối tác chất lượng, chúng tôi tin tưởng sẽ xây dựng thành công một hệ sinh thái GameBlockchain toàn diện và hiệu quả để phục vụ cộng đồng và nhà đầu tư trong tương lai.</li>
                            </ul>
                        </div>
                        <a href="#" class="vs-btn">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="vs-features-wrap space-extra">
        <div class="container">
            <div class="row justify-content-lg-around justify-content-xl-between gy-3 text-center text-xl-start">
                <div class="col-sm-6 col-xl-3 col-xxl-auto">
                    <div class="features-box mb-25">
                        <div class="features-box_icon"><img src="assets/img/icon/features-icon-2-1.png" alt="Features Icon" /></div>
                        <span class="features-box_label text-uppercase">Over watch</span>
                        <h3 class="features-box_title">Live Streaming</h3>
                        <p class="features-box_text">Praesent a ornare metus. Etiam luctus arcu a neque venenatis, quis hendrerit mi maximus.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-xxl-auto">
                    <div class="features-box mb-25">
                        <div class="features-box_icon"><img src="assets/img/icon/features-icon-2-2.png" alt="Features Icon" /></div>
                        <span class="features-box_label text-uppercase">Keep update</span>
                        <h3 class="features-box_title">Gaming News</h3>
                        <p class="features-box_text">Praesent a ornare metus. Etiam luctus arcu a neque venenatis, quis hendrerit mi maximus.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-xxl-auto">
                    <div class="features-box mb-25">
                        <div class="features-box_icon"><img src="assets/img/icon/features-icon-2-3.png" alt="Features Icon" /></div>
                        <span class="features-box_label text-uppercase">Enjoy time</span>
                        <h3 class="features-box_title">Great Tournament</h3>
                        <p class="features-box_text">Praesent a ornare metus. Etiam luctus arcu a neque venenatis, quis hendrerit mi maximus.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-xxl-auto">
                    <div class="features-box mb-25">
                        <div class="features-box_icon"><img src="assets/img/icon/features-icon-2-4.png" alt="Features Icon" /></div>
                        <span class="features-box_label text-uppercase">Be Legend</span>
                        <h3 class="features-box_title">Awward Ceremony</h3>
                        <p class="features-box_text">Praesent a ornare metus. Etiam luctus arcu a neque venenatis, quis hendrerit mi maximus.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop