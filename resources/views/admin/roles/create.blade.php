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
        .select2-selection--multiple .select2-search--inline:first-child .select2-search__field {
            padding-left: .5rem;
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
                    <a href="{{route('admin.roles.index')}}" class="breadcrumb-item">{{translate('breadcrumb.roles')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.newRole')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.roles.store')}}" method="post" data-reload="reload">
            @csrf
            <div class="card border-top-0 mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('roles.name')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="display_name">{{translate('roles.displayName')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="display_name" name="display_name">
                            </div>
                            @if($errors->has('display_name'))
                                <div class="text-danger">{{$errors->first('display_name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="description">{{translate('roles.description')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="description" name="description">
                            </div>
                            @if($errors->has('description'))
                                <div class="text-danger">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="permissions">{{translate('roles.permissions')}}</label>
                            <select name="permissions[]" id="permissions" class="form-control selectpicker" multiple data-live-search="true" data-selected-text-format="count" data-actions-box="true">
                                @foreach($permissions as $permission)
                                    @php
                                        $previousPermission = $permissions[$loop->iteration-2]??null;
                                        $nextPermission = $permissions[$loop->iteration]??null;
                                        $previousType = explode(' ',$previousPermission['display_name'])[1]??null;
                                        $currentType = explode(' ',$permission['display_name'])[1];
                                        $nextType = explode(' ',$nextPermission['display_name'])[1]??null;
                                    @endphp
                                    @if(!$previousPermission || ($previousPermission && $previousType!=$currentType))
                                        <optgroup label="{{explode(' ',$permission['display_name'])[1]}}">
                                    @endif

                                    <option value="{{$permission['id']}}">{{$permission['display_name']}}</option>

                                    @if($nextPermission && $nextType!=$currentType)
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                            @if($errors->has('permissions'))
                                <div class="text-danger">{{$errors->first('permissions')}}</div>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('roles.addNewRole')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection