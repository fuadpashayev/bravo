@extends('admin.layouts.layout')


@section('styles')
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
        .badge{
            width: 140px;
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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.roles')}}</span>
                </div>
            </div>
            @permission('create-roles')
                <div class="text-right">
                    <a href="{{route('admin.roles.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addRole')}} <b><i class="icon-plus2"></i></b></a>
                </div>
            @endpermission
        </div>
    </div>
    <!-- /page header -->
    <div class="content p-0">
        <div class="card-header d-none"></div>

        @if(session()->has('success'))
            {!! alert(session()->get('success')) !!}
        @endif
        <div class="card border-top-0">
            <div class="card-body">
                <table class="table datatable-basic dataTable no-footer" data-model="roles" width="100%">
                    <thead>
                        <tr>
                            @permission('delete-roles')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th>ID</th>
                            <th>{{translate('table.name')}}</th>
                            <th>{{translate('table.displayName')}}</th>
                            <th>{{translate('table.description')}}</th>
                            <th>{{translate('table.permissions')}}</th>
                            @permission('update-roles|delete-roles')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                @permission('delete-roles')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$role['id']}}"></td>
                                @endpermission
                                <td>{{$role['id']}}</td>
                                <td>{{$role['name']}}</td>
                                <td>{{$role['display_name']}}</td>
                                <td>{{$role['description']}}</td>
                                <td width="50%">
                                    @php($permissions = $role->permissions)
                                    @php($permissonsNumber = count($permissions))
                                    @foreach($permissions as $permission)
                                        @if($permissonsNumber>2)
                                            @if($loop->iteration===2)
                                                <div class="badge bg-info show-more">+ {{translate('common.showMore')}}</div>
                                                <div class="more-data">
                                                    @endif
                                                    <div class="badge bg-slate">{{$permission->display_name}}</div>
                                                    @if($loop->iteration===$permissonsNumber)
                                                        <div class="badge bg-info show-less">- {{translate('common.showLess')}}</div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="badge bg-slate">{{$permission->display_name}}</div>
                                        @endif

                                    @endforeach
                                </td>
                                @permission('update-roles|delete-roles')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-roles')
                                                <a href="{{route('admin.roles.edit',['role' => $role['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-roles')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="roles" data-type="role" data-id="{{$role['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-roles')
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