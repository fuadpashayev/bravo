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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.menus')}}</span>
                </div>
            </div>
            @permission('create-menus')
                <div class="text-right">
                    <a href="{{route('admin.menus.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addMenu')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-basic-no-order dataTable no-footer" data-model="menus" width="100%">
                    <thead>
                        <tr>
                            @permission('delete-menus')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th class="no-sort sorting_disabled" style="width: 100px">ID</th>
                            <th class="no-sort sorting_disabled">{{translate('table.name')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.description')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.url')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.target')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.order')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.status')}}</th>
                            @permission('update-permissions|delete-menus')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @php($color = generateHEXColor())
                        @foreach($menus as $menu)
                            <tr>
                                @permission('delete-menus')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$menu->id}}"></td>
                                @endpermission
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->description}}</td>
                                <td>{{$menu->url}}</td>
                                <td>
                                    @foreach(json_decode($menu->target) as $target)
                                        <div class="badge bg-slate">{{translate("menus.$target")}}</div>
                                    @endforeach
                                </td>
                                <td><span class="p-1 text-white rounded" style="background-color:#{{$color}}">{{$menu->order}}</span></td>
                                <td>{!! getStatus($menu->status) !!}</td>
                                @permission('update-menus|delete-menus')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-menus')
                                                <a href="{{route('admin.menus.edit',['menu' => $menu->id])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-menus')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="menus" data-type="menu" data-id="{{$menu->id}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                            @if($submenus = $menu->subMenus)
                                @include('admin.partials.menus.table', ['submenus' => $submenus,'layer' => 1,'existColors' => [$color]])
                            @endif
                        @endforeach
                    </tbody>
                    @permission('delete-menus')
                        <tfoot>
                            <tr>
                                <td style="padding: .75rem 0;" colspan="9"><button class="btn btn-danger btn-labeled btn-labeled-right deleteAll" disabled><span>{{translate('common.delete')}}</span><b><i class="icon-bin"></i></b></button></td>
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
