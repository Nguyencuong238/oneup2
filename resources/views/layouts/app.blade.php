<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-static">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link href="{{ asset('icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/default/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">

    @yield('css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
    <style>
        .media-library-hidden {
            display: none !important;
        }

        .navbar-brand img {
            height: 50px;
        }

        .collapse.in {
            display: block;
        }
    </style>
</head>

<body>
    <div class="page-content">

        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

            <div class="navbar navbar-dark bg-dark-100 navbar-static border-0">
                <div class="navbar-brand flex-fill wmin-0 py-2 text-center">
                    <a href="{{ route('home') }}" target="_blank" class="d-inline-block">
                        <img src="{{ asset('assets/logo.png') }}" alt="OneUp KOL"
                            class="sidebar-resize-hide">
                        <img src="{{ asset('assets/logo.png') }}" alt="OneUp KOL"
                            class="sidebar-resize-show">
                    </a>
                </div>

                <ul class="navbar-nav align-self-center ml-auto sidebar-resize-hide">
                    <li class="nav-item dropdown">
                        <button type="button"
                            class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="icon-transmission  "></i>
                        </button>

                        <button type="button"
                            class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                            <i class="icon-cross2"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="sidebar-content">

                <div class="sidebar-section">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">


                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="icon-home4"></i>
                                <span>
                                    {{ __('Bản điều khiển') }}
                                </span>
                            </a>
                        </li>

                        @canany('posts.view', 'posts.create', 'posts.edit', 'posts.delete')
                            <li class="nav-item">
                                <a href="/backend/posts" class="nav-link">
                                    <i class="icon-compose"></i>
                                    <span>
                                        {{ __('Tin tức') }}
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @canany('organizations.view', 'organizations.create', 'organizations.edit', 'organizations.delete')
						<li class="nav-item">
							<a href="{{ route('organizations.index') }}" class="nav-link">
								<i class="icon-compose"></i>
								<span>Tổ chức</span>
							</a>
						</li>
						@endcan 

                         @canany('campaigns.view', 'campaigns.create', 'campaigns.edit', 'campaigns.delete')
                        <li class="nav-item">
                            <a href="{{ route('campaigns.index') }}" class="nav-link">
                                <i class="icon-grid6"></i>
                                <span>
									Chiến dịch
								</span>
                            </a>
                        </li>
                        @endcan 

                        {{-- <li class="nav-item">
                            <a href="{{ route('channels.index') }}" class="nav-link">
                                <i class="icon-grid6"></i>
                                <span>
									Channels
								</span>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('kols.index') }}" class="nav-link">
                                <i class="icon-grid6"></i>
                                <span>
                                    Nhà sáng tạo nội dung
                                </span>
                            </a>
                        </li>

                        @canany('newsletters.view', 'newsletters.create', 'newsletters.edit', 'newsletters.delete')
                            <li class="nav-item">
                                <a href="{{ route('newsletters.index') }}" class="nav-link">
                                    <i class="icon-shield2"></i>
                                    <span>
                                        Liên hệ
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @canany('categories.view', 'categories.create', 'categories.edit', 'categories.delete')
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="icon-folder-open2"></i>
                                    <span>
                                        {{ __('Danh mục') }}
                                    </span>
                                </a>
                            </li>
                        @endcan

                        {{-- @canany('tags.view', 'tags.create', 'tags.edit', 'tags.delete')
						<li class="nav-item">
							<a href="{{ route('tags.index') }}" class="nav-link">
								<i class="icon-price-tags"></i>
								<span>
									{{ __('Thẻ') }}
								</span>
							</a>
						</li>
						@endcan  --}}

                        {{--  @canany('banners.view', 'banners.create', 'banners.edit', 'banners.delete')
						<li class="nav-item">
							<a href="{{ route('banners.index') }}" class="nav-link">
								<i class="icon-image2"></i>
								<span>
									{{ __('Banner') }}
								</span>
							</a>
						</li>
						@endcan  --}}

                        {{-- @canany('gallery.view', 'gallery.create', 'gallery.edit', 'gallery.delete')
                            <li class="nav-item">
                                <a href="{{ route('gallery.index') }}" class="nav-link">
                                    <i class="icon-grid6"></i>
                                    <span>
									{{ __('Gallery') }}
								</span>
                                </a>
                            </li>
                        @endcan  --}}

                        {{--  @canany('videos.view', 'videos.create', 'videos.edit', 'videos.delete')
						<li class="nav-item">
							<a href="{{ route('videos.index') }}" class="nav-link">
								<i class="icon-clapboard-play"></i>
								<span>
									{{ __('Video') }}
								</span>
							</a>
						</li>
						@endcan  --}}

                        {{--  @canany('notifications.view', 'notifications.create', 'notifications.edit', 'notifications.delete')
                            <li class="nav-item">
                                <a href="{{ route('notifications.index') }}" class="nav-link">
                                    <i class="icon-bell3"></i>
                                    <span>
									{{ __('Notification') }}
								</span>
                                </a>
                            </li>
                        @endcan  --}}

                        {{--  @canany('projects.view', 'projects.create', 'projects.edit', 'projects.delete')
						<li class="nav-item">
							<a href="{{ route('projects.index') }}" class="nav-link">
								<i class="icon-location4"></i>
								<span>
									{{ __('Locations') }}
								</span>
							</a>
						</li>
						@endcan  --}}

                        @canany('users.view', 'users.create', 'users.edit', 'users.delete')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="icon-users4"></i>
                                    <span>
                                        {{ __('Users') }}
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @canany('roles.view', 'roles.create', 'roles.edit', 'roles.delete')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="icon-shield2"></i>
                                    <span>
                                        {{ __('Roles') }}
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @canany('setting.view', 'setting.create', 'setting.edit', 'setting.delete')
                            <li class="nav-item">
                                <a href="{{ route('setting.home') }}" class="nav-link">
                                    <i class="icon-cog"></i>
                                    <span>
                                        Cài đặt
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>

            </div>

        </div>

        <div class="content-wrapper">

            <div class="navbar navbar-expand-lg navbar-light navbar-static">
                <div class="d-flex flex-1 d-lg-none">
                    <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                        <i class="icon-transmission"></i>
                    </button>

                    <button data-target="#navbar-search" type="button" class="navbar-toggler" data-toggle="collapse">
                        <i class="icon-search4"></i>
                    </button>
                </div>

                <div class="navbar-collapse collapse flex-lg-1 order-2 order-lg-1" id="navbar-search">
                    <div class="navbar-search d-flex align-items-center py-2 py-lg-0">
                        <div class="form-group-feedback form-group-feedback-left flex-grow-1">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="form-control-feedback">
                                <i class="icon-search4 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user">
                            <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle"
                                data-toggle="dropdown">
                                <img src="/images/user.jpg" class="rounded-pill mr-lg-2" height="34"
                                    alt="">
                                <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('profile.show') }}" class="dropdown-item"><i
                                        class="icon-user-plus"></i> {{ __('Profile') }}</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
										this.closest('form').submit();"><i
                                            class="icon-switch2"></i> {{ __('Log Out') }}</a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="page-header">
                <div class="page-header page-header-light">

                    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i
                                        class="icon-home2 mr-2"></i> {{ __('Dashboard') }}</a>
                            </div>

                            <a href="#" class="header-elements-toggle text-body d-lg-none"><i
                                    class="icon-more"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-bordered alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        Vui lòng kiểm tra lại dữ liệu nhập vào
                    </div>
                @endif
                @if (flash()->message)
                    <div class="alert alert-{{ flash()->class }} alert-bordered alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        {{ flash()->message }}
                    </div>
                @endif
                {{ $slot }}

            </div>

            <div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                        data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>
            </div>

        </div>

    </div>
    @livewireScripts
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('plugins/forms/selects/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin" defer>
    </script>

    <script>
        function setSearchSelect2(selector, searchUrl) {

            if (selector.length > 0) {
                selector.select2({
                    width: '100%',
                    ajax: {
                        url: searchUrl,
                        datatype: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;

                            return {
                                results: data.data,
                                pagination: {
                                    more: (params.page * 15) < data.total
                                }
                            };
                        },
                        templateSelection: function(item) {
                            return item.name || item.text;
                        }
                    },
                });

                let selected = selector.val();

                if (selector.attr('multiple')) {
                    if (selector.val().length > 0) {
                        selected = selector.val().join(',');
                    } else {
                        selected = null;
                    }
                }

                if (selected) {
                    $.ajax({
                        type: 'GET',
                        url: searchUrl + '?id=' + selected
                    }).then(function(res) {
                        selector.empty().trigger("change");

                        // create the option and append to Select2
                        res.forEach(function(data) {
                            var option = new Option(data.text, data.id, true, true);
                            selector.append(option).trigger('change');

                            // manually trigger the `select2:select` event
                            selector.trigger({
                                type: 'select2:select',
                                params: {
                                    data: data
                                }
                            });
                        })
                    });
                }

            }
        }

        $(function() {
            $('.form-control-select2').select2();

            $('[data-behavior~=delete-resource]').on('click', function() {
                if (!confirm('{{ __('Are you sure to delete this resource') }}')) {
                    return;
                }

                var $this = $(this);
                var $body = $('body');

                var actionUrl = $this.data('action-url');
                var csrf = $('meta[name="csrf-token"]').attr('content');

                var $form = $("<form action='" + actionUrl +
                    "' method='POST'><input type='hidden' name='_token' value='" + csrf +
                    "' /><input type='hidden' name='_method' value='delete' /></form>")

                $body.append($form);

                $form.submit();
            });

            tinymce.init({
                selector: '.editor',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                imagetools_cors_hosts: ['picsum.photos'],
                menubar: 'file edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                toolbar_sticky: true,
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_prefix: '{path}{query}-{id}-',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,
                importcss_append: true,
                templates: [{
                        title: 'New Table',
                        description: 'creates a new table',
                        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                    },
                    {
                        title: 'Starting my story',
                        description: 'A cure for writers block',
                        content: 'Once upon a time...'
                    },
                    {
                        title: 'New list with dates',
                        description: 'New List with dates',
                        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                    }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quicktable',
                noneditable_noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link image imagetools table',
                skin: 'oxide',
                content_css: 'default',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                file_picker_callback: elFinderBrowser,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                toolbar_mode: 'wrap',
                language_url: "/plugins/tinymce_languages/langs/vi.js",
                language: 'vi',
                quickbars_insert_toolbar: 'quicktable image media codesample',
                extended_valid_elements: "script[async|src|charset],iframe[src|title|width|height|allowfullscreen|frameborder],img[class|style|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|loading=lazy]"
            });

            function elFinderBrowser(callback, value, meta) {
                tinymce.activeEditor.windowManager.openUrl({
                    title: 'File Manager',
                    url: "{{ route('elfinder.tinymce5') }}",
                    /**
                     * On message will be triggered by the child window
                     *
                     * @param dialogApi
                     * @param details
                     * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
                     */
                    onMessage: function(dialogApi, details) {
                        if (details.mceAction === 'fileSelected') {
                            const file = details.data.file;

                            // Make file info
                            const info = file.name;

                            console.log(file)

                            // Provide file and text for the link dialog
                            if (meta.filetype === 'file') {
                                callback(file.url, {
                                    text: info,
                                    title: info
                                });
                            }

                            // Provide image and alt text for the image dialog
                            if (meta.filetype === 'image') {
                                callback(file.url, {
                                    alt: info
                                });
                            }

                            // Provide alternative source and posted for the media dialog
                            if (meta.filetype === 'media') {
                                callback(file.url);
                            }

                            dialogApi.close();
                        }
                    }
                });
            }
        })
    </script>

    @stack('js')
</body>

</html>
