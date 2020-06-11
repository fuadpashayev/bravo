@extends('admin.layouts.layout')


@section('styles')
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
        #infos .row {
            border-bottom: 1px solid #ebebeb;
            margin: 10px 0;
        }
        #infos .row:last-child {
            border-bottom: 0;
        }
    </style>
@endsection

@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                    <a href="{{route('admin.users.index')}}" class="breadcrumb-item">{{translate('breadcrumb.users')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.newUser')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.users.store')}}" method="post" data-reload="reload">
            @csrf
            <div class="card border-top-0 mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('users.fullName')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="email">{{translate('users.email')}}</label>
                            <input class="form-control" id="email" name="email">
                            @if($errors->has('email'))
                                <div class="text-danger">{{$errors->first('email')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="password">{{translate('users.password')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="password" name="password">
                                <div class="input-group-append">
                                    <a data-false title="Generate password" class="btn bg-slate generatePassword"><b><i class="icon-lock"></i></b></a>
                                </div>
                            </div>
                            @if($errors->has('password'))
                                <div class="text-danger">{{$errors->first('password')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="role">{{translate('users.role')}}</label>
                            <select name="role" id="role" class="form-control select2">
                                @foreach($roles as $role)
                                    <option value="{{$role['name']}}">{{$role['display_name']}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role'))
                                <div class="text-danger">{{$errors->first('role')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <a data-false class="btn btn-labeled btn-labeled-right bg-slate addInfo">{{translate('users.addNewInfo')}} <b><i class="icon-plus2"></i></b></a>
                    </div>

                    <div id="infos"></div>

                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('users.addNewUser')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>

    </script>
@endsection