<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pashayev.info</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/custom.css?123456')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/sweet-alert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/loader.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/datatables_row_group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('panel/css/extras/animate.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('general/css/fancyBox.css')}}" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('panel/js/main/jquery.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/main/bootstrap.bundle.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/loaders/blockui.min.js?12345')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="{{asset('panel/js/plugins/forms/styling/switchery.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/forms/styling/uniform.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/ui/moment/moment.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/pickers/daterangepicker.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/forms/selects/select2.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/notifications/noty.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/notifications/sweet_alert.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/editors/ckeditor/ckeditor.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/ui/dragula.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.7/cropper.min.js"></script>
    <script src="{{asset('general/js/fancyBox.js')}}"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>



    <script src="{{asset('panel/js/app.js?12345')}}"></script>

    <script>
        let locale = '{{getLocale()}}';
        let locales = {!! (getLocales()) !!};
        let allLocales = locales;
        let yandexUrl = '{{yandexUrl()}}';
        let mediaUrl = '{{url('media?media-action=select-files')}}';
        let RV_MEDIA_URL = {!! json_encode(RvMedia::getUrls()) !!};
        let RV_MEDIA_CONFIG = {!! json_encode([
        'permissions' => RvMedia::getPermissions(),
        'pagination' => [
            'paged' => config('media.pagination.paged'),
            'posts_per_page' => config('media.pagination.per_page'),
            'in_process_get_media' => false,
            'has_more' =>  true,
        ],
    ]) !!}
    </script>
    <script src="{{asset('panel/js/serialize.js?12345')}}"></script>
    <script src="{{asset('vendor/media/js/media.js')}}"></script>
    <script src="{{asset('panel/js/pashayev.js?123456')}}"></script>
    <script src="{{asset('panel/js/plugins/tables/datatables/datatables.min.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/tables/datatables/extensions/row_group.js?12345')}}"></script>
    <script src="{{asset('panel/js/plugins/tables/datatables/datatable_basic.js?123456')}}"></script>
    <script src="{{asset('panel/js/custom.js?12345671')}}"></script>
    <!-- /theme JS files -->


    @yield('styles')
</head>

<body class="navbar-top">

<div id="iframe-layer">
    <div id="iframe" class="my-sm-3 my-md-5">
        <div id="iframe-close">×</div>
        <div id="iframe-content"></div>
    </div>
</div>

<div id="modal-layer">
    <div id="modal" class="my-sm-3 my-md-5">
        <div id="modal-close">×</div>
        <div id="modal-title"></div>
        <div id="modal-content"></div>
        <div id="modal-buttons"></div>
    </div>
</div>

<div id="loader">
    <div class="loading-spinner-ripple">
        <div class="ripple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<!-- Main navbar -->
@auth
<div class="navbar navbar-expand-md navbar-light fixed-top">

    <!-- Header with logos -->
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="{{route('admin.dashboard')}}" class="d-inline-block">
                <img src="{{asset('panel/images/logo_light.png')}}" alt="">
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs">
            <a href="{{route('admin.dashboard')}}" class="d-inline-block">
                <img src="{{asset('panel/images/logo_icon_light.png')}}" alt="">
            </a>
        </div>
    </div>
    <!-- /header with logos -->


    <!-- Mobile controls -->
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="{{route('admin.dashboard')}}" class="d-inline-block">
                <img src="{{asset('panel/images/logo_dark.png')}}" alt="">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <!-- /mobile controls -->


    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">&nbsp;{{getLanguage()->name}}</a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(getLanguages() as $language)
                        <a href="{{route('setLocale',['language' => $language->key])}}" class="dropdown-item">{{$language->name}}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('panel/images/image.png')}}" class="rounded-circle mr-2" height="34" alt="">
                    <span>{{user()->name}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="javascript:void(0)" onclick="document.getElementById('logout').submit()" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                    <form id="logout" action="{{route('logout')}}" style="display:none;" method="post">@csrf</form>
                </div>
            </li>
        </ul>
    </div>
    <!-- /navbar content -->

</div>
@endauth
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    @auth
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                Navigation
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->


            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#"><img src="{{asset('panel/images/image.png')}}" width="38" height="38" class="rounded-circle" alt=""></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">{{user()->name}}</div>
                                <div class="font-size-xs opacity-50">
                                    <i class="icon-pin font-size-sm"></i> &nbsp;{{user()->info->address}}
                                </div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                @php($route = Route::currentRouteName())
                <!-- Main navigation -->
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        @permission('read-pages|read-menus|read-menus|read-pages|read-categories|read-posts|read-sliders|read-banners|read-offers')
                            <!-- Main -->
                            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{translate('menuLabels.main')}}</div></li>
                            @php($routeList = ['admin.dashboard'])
                            <li class="nav-item {{checkRouteGroupActive($routeList,'')}}">
                                <a href="{{route('admin.dashboard')}}" class="nav-link">
                                    <i class="icon-home4"></i>
                                    <span>{{translate('navigation.dashboard')}}</span>
                                </a>
                            </li>

                            @permission('read-pages|read-menus')
                            @php($routeList = ['admin.pages.index','admin.menus.index'])
                            <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                <a href="#" class="nav-link"><i class="icon-make-group"></i> <span>{{translate('navigation.pages')}}</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Pages">
                                    @permission('read-menus')
                                    <li class="nav-item"><a href="{{route('admin.menus.index')}}" class="nav-link {{checkRouteMenuActive('admin.menus.index')}}"><i class="icon-menu7"></i> <span>{{translate('navigation.menus')}}</span></a></li>
                                    @endpermission

                                    @permission('read-pages')
                                    <li class="nav-item"><a href="{{route('admin.pages.index')}}" class="nav-link {{checkRouteMenuActive('admin.pages.index')}}"><i class="icon-magazine"></i> <span>{{translate('navigation.pages')}}</span></a></li>
                                    @endpermission
                                </ul>
                            </li>
                            @endpermission

                            @permission('read-categories|read-posts')
                            @php($routeList = ['admin.categories.index','admin.posts.index'])
                            <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                <a href="#" class="nav-link"><i class="icon-stack-text"></i> <span>{{translate('navigation.posts')}}</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Posts">
                                    @permission('read-categories')
                                        <li class="nav-item"><a href="{{route('admin.categories.index')}}" class="nav-link {{checkRouteMenuActive('admin.categories.index')}}"><i class="icon-list-unordered"></i> <span>{{translate('navigation.categories')}}</span></a></li>
                                    @endpermission

                                    @permission('read-posts')
                                       <li class="nav-item"><a href="{{route('admin.posts.index')}}" class="nav-link {{checkRouteMenuActive('admin.posts.index')}}"><i class="icon-newspaper"></i> <span>{{translate('navigation.posts')}}</span></a></li>
                                    @endpermission
                                </ul>
                            </li>
                            @endpermission

                            @permission('read-sliders|read-banners')
                            @php($routeList = ['admin.sliders.index','admin.banners.index'])
                            <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                <a href="#" class="nav-link"><i class="icon-film"></i> <span>{{translate('navigation.sliders')}}</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Sliders">
                                    @permission('read-sliders')
                                    <li class="nav-item"><a href="{{route('admin.sliders.index')}}" class="nav-link {{checkRouteMenuActive('admin.sliders.index')}}"><i class="icon-image-compare"></i> <span>{{translate('navigation.sliders')}}</span></a></li>
                                    @endpermission

                                    @permission('read-banners')
                                    <li class="nav-item"><a href="{{route('admin.banners.index')}}" class="nav-link {{checkRouteMenuActive('admin.banners.index')}}"><i class="icon-images2"></i> <span>{{translate('navigation.banners')}}</span></a></li>
                                    @endpermission
                                </ul>
                            </li>
                            @endpermission

                            @permission('read-offers')
                            @php($routeList = ['admin.offers.index'])
                            <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                <a href="#" class="nav-link"><i class="icon-price-tags"></i> <span>{{translate('navigation.offers')}}</span></a>
                                <ul class="nav nav-group-sub" data-submenu-title="Offers">
                                    @permission('read-offers')
                                    <li class="nav-item"><a href="{{route('admin.offers.index')}}" class="nav-link {{checkRouteMenuActive('admin.offers.index')}}"><i class="icon-price-tag2"></i> <span>{{translate('navigation.offers')}}</span></a></li>
                                    @endpermission
                                </ul>
                            </li>
                            @endpermission

                            <!-- /main -->

                            <!-- other -->
                            @permission('read-users|read-roles|read-permissions|read-languages|read-translation-groups|read-translations|read-settings"read-media')
                                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{{translate('menuLabels.other')}}</div> <i class="icon-menu" title="Other"></i></li>

                                @permission('read-users|read-roles|read-permissions')
                                @php($routeList = ['admin.users.index','admin.roles.index','admin.permissions.index'])
                                <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                    <a href="#" class="nav-link"><i class="icon-users"></i> <span>{{translate('navigation.users')}}</span></a>
                                    <ul class="nav nav-group-sub" data-submenu-title="Portfolio">
                                        @permission('read-users')
                                        <li class="nav-item"><a href="{{route('admin.users.index')}}" class="nav-link {{checkRouteMenuActive('admin.users.index')}}"><i class="icon-user"></i> <span>{{translate('navigation.users')}}</span></a></li>
                                        @endpermission
                                        @permission('read-roles')
                                        <li class="nav-item"><a href="{{route('admin.roles.index')}}" class="nav-link {{checkRouteMenuActive('admin.roles.index')}}"><i class="icon-graduation"></i> <span>{{translate('navigation.roles')}}</span></a></li>
                                        @endpermission
                                        @permission('read-permissions')
                                        <li class="nav-item"><a href="{{route('admin.permissions.index')}}" class="nav-link {{checkRouteMenuActive('admin.permissions.index')}}"><i class="icon-shield-check"></i> <span>{{translate('navigation.permissions')}}</span></a></li>
                                        @endpermission
                                        {{--<li class="nav-item-divider"></li>--}}
                                    </ul>
                                </li>
                                @endpermission


                                @permission('read-languages|read-translation-groups|read-translations')
                                @php($routeList = ['admin.languages.index','admin.translation_groups.index','admin.translations.index'])
                                    <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                        <a href="#" class="nav-link"><i class="icon-clipboard6"></i> <span>{{translate('navigation.localization')}}</span></a>
                                        <ul class="nav nav-group-sub" data-submenu-title="Settings">
                                            @permission('read-languages')
                                                <li class="nav-item"><a href="{{route('admin.languages.index')}}" class="nav-link {{checkRouteMenuActive('admin.languages.index')}}"><i class="icon-cloud2"></i> <span>{{translate('navigation.languages')}}</span></a></li>
                                            @endpermission
                                            @permission('read-translation-groups')
                                                <li class="nav-item"><a href="{{route('admin.translation_groups.index')}}" class="nav-link {{checkRouteMenuActive('admin.translation_groups.index')}}"><i class="icon-grid3"></i> <span>{{translate('navigation.translation_groups')}}</span></a></li>
                                            @endpermission
                                            @permission('read-translations')
                                                <li class="nav-item"><a href="{{route('admin.translations.index')}}" class="nav-link {{checkRouteMenuActive('admin.translation.index')}}"><i class="icon-earth"></i> <span>{{translate('navigation.translations')}}</span></a></li>
                                            @endpermission
                                        </ul>
                                    </li>
                                @endpermission


                                @permission('read-settings')
                                @php($routeList = ['admin.config'])
                                    <li class="nav-item nav-item-submenu {{checkRouteGroupActive($routeList)}}">
                                        <a href="#" class="nav-link"><i class="icon-cog6"></i> <span>{{translate('navigation.settings')}}</span></a>
                                        <ul class="nav nav-group-sub" data-submenu-title="Settings">
                                            @permission('read-settings')
                                                <li class="nav-item"><a href="{{route('admin.config')}}" class="nav-link {{checkRouteMenuActive('admin.config')}}"><i class="icon-wrench"></i> <span>{{translate('navigation.config')}}</span></a></li>
                                            @endpermission
                                        </ul>
                                    </li>
                                @endpermission

                                @permission('read-media')
                                <li class="nav-item "><a href="/media" class="nav-link"><i class="icon-gallery"></i> <span>{{translate('navigation.mediaManager')}}</span></a></li>
                                @endpermission
                            @endpermission
                        @endpermission

                        <!-- /other -->

                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
    @endauth

    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /main content -->

</div>
        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">

            <div class="navbar-collapse" id="navbar-footer">
                <span class="navbar-text">
                    &copy; 2019 - {{date('Y')}}. All rights reserved! <a href="{{route('home')}}">Pashayev.info</a>
                </span>
            </div>
        </div>
        <!-- /footer -->
<!-- /page content -->

@yield('scripts')

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159915271-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-159915271-1');
</script>

</body>
</html>
