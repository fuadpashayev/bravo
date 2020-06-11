@extends('admin.layouts.layout')


@section('styles')
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
    </style>
@endsection

@section('content')

    <div class="page-header page-header-light" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.users')}}</span>
                </div>
            </div>
            @permission('create-users')
                <div class="text-right">
                    <a href="{{route('admin.users.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addUser')}} <b><i class="icon-plus2"></i></b></a>
                </div>
            @endpermission
        </div>
    </div>
    <!-- /page header -->
    <div class="content p-0">
        <div class="card border-top-0">
            <div class="card-header d-none"></div>

            @if(session()->has('success'))
                {!! alert(session()->get('success')) !!}
            @endif
            <div class="card-body">
                <table class="table datatable-basic dataTable no-footer" data-model="users" width="100%">
                    <thead>
                        <tr>
                            <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.name')}}</th>
                            <th>{{translate('table.email')}}</th>
                            <th>{{translate('table.info')}}</th>
                            <th>{{translate('table.role')}}</th>
                            @permission('update-users|delete-users')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @php($colors = config('role_colors'))
                        @foreach($users as $user)
                            @php($userInfo = json_decode($user['info'],1))
                            <tr>
                                <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$user['id']}}"></td>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td width="35%">
                                    @foreach($userInfo as $info=>$value)
                                        @if(count($userInfo)>2)
                                            @if($loop->iteration===2)
                                                <div class="badge bg-info show-more">+ {{translate('badges.showMore')}}</div>
                                                <div class="more-data">
                                            @endif
                                            <div class="badge bg-white border-1 border-slate" style="margin:1px 0;"> {{translate("users.$info")}}: <span class="text-slate font-weight-bold p-1 rounded">{{$value}}</span></div>
                                            @if($loop->iteration===count($userInfo))
                                                    <div class="badge bg-info show-less">- {{translate('badges.showLess')}}</div>
                                                </div>
                                             @endif
                                        @else
                                            <div class="badge bg-white border-1 border-slate" style="margin:1px 0;"> {{translate("users.$info")}}: <span class="text-slate font-weight-bold p-1 rounded">{{$value}}</span></div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if(isset($user->roles[0]))
                                        @php($role = $user->roles[0])
                                        <div class="badge bg-{{$colors[$role->name]}}">{{$role->display_name}}</div>
                                    @else
                                        <div class="badge bg-danger">{{translate('errors.noRoleAssigned')}}</div>
                                    @endif
                                </td>
                                @permission('update-users|delete-users')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-users')
                                                <a href="{{route('admin.users.edit',['user' => $user['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-users')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="users" data-type="user" data-id="{{$user['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-users')
                        <tfoot>
                            <tr>
                                <td style="padding: .75rem 0;" colspan="7"><button class="btn btn-danger btn-labeled btn-labeled-right deleteAll" disabled><span>{{translate('common.delete')}}</span><b><i class="icon-bin"></i></b></button></td>
                            </tr>
                        </tfoot>
                    @endpermission
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

    </script>
@endsection