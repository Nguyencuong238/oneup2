<div class="dashboard-items">
    <ul>
        <li>
            <a href="{{route('user.dashboard')}}" @if(request()->fullUrl() == route('user.dashboard')) class="text-danger" @endif>
                <i class="fa fa-cog"></i>{{ __('Cài đặt') }}</a>
        </li>

        <li>
            <a href="{{route('user.department')}}" @if(request()->fullUrl() == route('user.department')) class="text-danger" @endif>
                <i class="fa fa-th-large"></i>{{ __('Thông tin Ban ngành/Cộng đoàn') }}</a>
        </li>
        
        <li>
            <a href="{{route('executives.index')}}" @if(strpos(Route::currentRouteName(), 'executives.') === 0) class="text-danger" @endif>
                <i class="fa fa-sitemap"></i>{{ __('Thông tin Ban điều hành') }}</a>
        </li>
        
        <li>
            <a href="{{route('action-news.index')}}" @if(strpos(Route::currentRouteName(), 'action-news.') === 0) class="text-danger" @endif>
                <i class="fa fa-list-alt"></i>{{ __('Tin hoạt động') }}</a>
        </li>

        <li>
            <a href="{{route('user-album.index')}}" @if(strpos(Route::currentRouteName(), 'user-album.') === 0) class="text-danger" @endif>
                <i class="fa fa-picture-o"></i>{{ __('Hình ảnh') }}</a>
        </li>

        <li>
            <a href="{{route('user-video.index')}}" @if(strpos(Route::currentRouteName(), 'user-video.') === 0) class="text-danger" @endif>
                <i class="fa fa-youtube-play"></i>{{ __('Video') }}</a>
        </li>
    </ul>
</div>
<style>
    .dashboard-items {
        padding: 28px 0 42px;
        border-radius: 6px;
        background-color: #fff;
    }
    .dashboard-items ul {
        padding-left: 10px;
    }
    .dashboard-items ul li {
        padding: 15px 0 15px 15px;
        border-left: 3px solid #FFF;
        -webkit-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
    .dashboard-items ul li a {
        color: #444;
        font-weight: normal;
    }
    .dashboard-items ul li:hover {
        color: var(--text-red-color);
        background-color: #F6F7FC;
        border-left: 3px solid var(--text-red-color);
        -webkit-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
    .dashboard-items ul li:hover a {
        color: var(--text-red-color);
    }
    .dashboard-items ul li.active {
        color: var(--text-red-color);
        background-color: #F6F7FC;
        border-left: 3px solid var(--text-red-color);
    }
    .dashboard-items ul li.active a {
        color: var(--text-red-color);
    }
    .dashboard-items ul li i {
        font-size: 20px;
        margin-right: 8px;
        opacity: 0.5;
    }
    .dashboard-items ul li:hover i {
        color: var(--text-red-color);
        opacity: 1;
        -webkit-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
    .dashboard-items ul li i.active {
        color: var(--text-blue-color);
        opacity: 1;
    }
    .dashboard-items ul li:hover {
        color: var(--text-red-color);
        background-color: #F6F7FC;
        border-left: 3px solid var(--text-red-color);
        -webkit-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
</style>