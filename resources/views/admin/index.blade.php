@extends('admin.layouts.layout')

@section('content')
    <!-- Page header -->
    <div class="page-header">
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('users')}}</h3>
                            <span class="text-uppercase font-size-xs">total users</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-users icon-2x opacity-75 text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('menus')}}</h3>
                            <span class="text-uppercase font-size-xs">total menus</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-menu7 icon-2x opacity-75 text-danger-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('roles')}}</h3>
                            <span class="text-uppercase font-size-xs">total roles</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-graduation icon-2x opacity-75 text-slate-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('permissions')}}</h3>
                            <span class="text-uppercase font-size-xs">total permissions</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-shield-check icon-2x opacity-75 text-green-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('languages')}}</h3>
                            <span class="text-uppercase font-size-xs">total languages</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-cloud2 icon-2x opacity-75 text-indigo-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('translation_groups')}}</h3>
                            <span class="text-uppercase font-size-xs">total translation groups</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-grid3 icon-2x opacity-75 text-orange-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{getCounts('translations')}}</h3>
                            <span class="text-uppercase font-size-xs">total translations</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-earth icon-2x opacity-75 text-teal-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">0</h3>
                            <span class="text-uppercase font-size-xs">total settings</span>
                        </div>

                        <div class="ml-3 align-self-center">
                            <i class="icon-cog icon-2x opacity-75 text-warning-400"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- /content area -->
@endsection
