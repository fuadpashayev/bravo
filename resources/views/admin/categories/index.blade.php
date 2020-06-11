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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.categories')}}</span>
                </div>
            </div>
            @permission('create-categories')
                <div class="text-right">
                    <a href="{{route('admin.categories.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addCategory')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-basic-no-order dataTable no-footer" data-model="categories" width="100%">
                    <thead>
                        <tr>
                            @permission('delete-categories')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th class="no-sort sorting_disabled" style="width: 100px">ID</th>
                            <th class="no-sort sorting_disabled">{{translate('table.name')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.description')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.order')}}</th>
                            <th class="no-sort sorting_disabled">{{translate('table.status')}}</th>
                            @permission('update-permissions|delete-categories')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @php($color = generateHEXColor())
                        @foreach($categories as $category)
                            <tr>
                                @permission('delete-categories')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$category['id']}}"></td>
                                @endpermission
                                <td>{{$category['id']}}</td>
                                <td>{{$category['name']}}</td>
                                <td>{{$category['description']}}</td>
                                <td><span class="p-1 text-white rounded" style="background-color:#{{$color}}">{{$category['order']}}</span></td>
                                <td>{!! getStatus($category['status']) !!}</td>
                                @permission('update-categories|delete-categories')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-categories')
                                                <a href="{{route('admin.categories.edit',['category' => $category['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-categories')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="categories" data-type="category" data-id="{{$category['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                            @if($subcategories = $category->subcategories)
                                @include('admin.partials.categories.table', ['subcategories' => $subcategories,'layer' => 1,'existColors' => [$color]])
                            @endif
                        @endforeach
                    </tbody>
                    @permission('delete-categories')
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
