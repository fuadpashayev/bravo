@extends('admin.layouts.layout')


@section('styles')
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
        table.dataTable tr.dtrg-group.dtrg-level-0 td {
            background: #607d8b40;
        }
    </style>
@endsection

@section('content')

    <div class="page-header page-header-light" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.permissions')}}</span>
                </div>
            </div>
            @permission('create-permissions')
                <div class="text-right">
                    <a href="{{route('admin.permissions.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addPermission')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-with-row-group dataTable no-footer" data-model="permissions" data-group="5" width="100%">
                    <thead>
                        <tr>
                            @permission('delete-permissions')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.name')}}</th>
                            <th>{{translate('table.displayName')}}</th>
                            <th>{{translate('table.description')}}</th>
                            <th>{{translate('table.module')}}</th>
                            @permission('update-permissions|delete-permissions')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                @permission('delete-permissions')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$permission['id']}}"></td>
                                @endpermission
                                <td>{{$permission['id']}}</td>
                                <td>{{$permission['name']}}</td>
                                <td>{{$permission['display_name']}}</td>
                                <td>{{$permission['description']}}</td>
                                <td>{{ucfirst($permission['module'])}}</td>
                                @permission('update-permissions|delete-permissions')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-permissions')
                                                <a href="{{route('admin.permissions.edit',['permission' => $permission['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-permissions')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="permissions" data-type="permission" data-id="{{$permission['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-permissions')
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