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
                    <span class="breadcrumb-item active">{{$user['name']}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.users.update',['user' => $user['id']])}}" method="post" data-reload="reload">
            @csrf
            @method('PUT')
            <div class="card border-top-0 mb-0">
                @if(session()->has('success'))
                    {!! alert(session()->get('success')) !!}
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('users.fullName')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name" value="{{$user['name']}}">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="email">{{translate('users.email')}}</label>
                            <input class="form-control" id="email" name="email" value="{{$user['email']}}">
                            @if($errors->has('email'))
                                <div class="text-danger">{{$errors->first('email')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="password">{{translate('users.password')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="password" name="password" placeholder="{{translate('users.dontTouchIfNotChange')}}">
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
                                <option value="-1">{{translate('options.selectRole')}}</option>
                                @foreach($roles as $role)
                                    <option value="{{$role['name']}}" {{@$user->roles[0]->name===$role['name']?'selected':''}}>{{$role['display_name']}}</option>
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

                    <div id="infos">
                        @foreach(json_decode($user['info'],1) as $info => $value)
                            <div class="row">
                                <div class="form-group px-0 pr-sm-1 col-lg-6 col-md-6 col-sm-6">
                                    <label for="name_{{uniqid()}}">{{translate('users.infoName')}}</label>
                                    <input class="form-control" id="name_{{uniqid()}}" name="info_names[]" value="{{$info}}">
                                </div>
                                <div class="form-group px-0 pl-sm-1 col-lg-6 col-md-6 col-sm-6">
                                    <label for="value_{{uniqid()}}">{{translate('users.infoValue')}}</label>
                                    <div class="input-group">
                                        <input class="form-control" id="value_{{uniqid()}}" name="info_values[]" value="{{$value}}">
                                        <div class="input-group-append">
                                            <button class="btn bg-danger deleteInfo"><b><i class="icon-bin"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('users.editUser')}}</button>
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