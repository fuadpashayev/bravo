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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.languages')}}</span>
                </div>
            </div>
            @permission('create-languages')
            <div class="text-right">
                <a href="{{route('admin.languages.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addLanguage')}} <b><i class="icon-plus2"></i></b></a>
            </div>
            @endpermission
        </div>
    </div>
    <!-- /page header -->
    <div class="content p-0">
        <div class="card border-top-0">
            <div class="card-header d-none">
            </div>

            @if(session()->has('success'))
                {!! alert(session()->get('success')) !!}
            @endif
            <div class="card-body">
                <table class="table datatable-order dataTable no-footer" data-model="languages" width="100%">
                    <thead>
                        <tr>
                            @permission('delete-languages')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.key')}}</th>
                            <th>{{translate('table.name')}}</th>
                            <th>{{translate('table.description')}}</th>
                            <th>{{translate('table.order')}}</th>
                            <th>{{translate('table.status')}}</th>
                            @permission('update-languages|delete-languages')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $language)
                            <tr>
                                @permission('delete-languages')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$language['id']}}"></td>
                                @endpermission
                                <td>{{$language['id']}}</td>
                                <td>{{$language['key']}}</td>
                                <td>{{$language['name']}}</td>
                                <td>{{$language['description']}}</td>
                                <td>{{$language['order']}}</td>
                                <td>{!! getStatus($language['status']) !!}</td>
                                @permission('update-languages|delete-languages')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-languages')
                                                <a href="{{route('admin.languages.edit',['language' => $language['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-languages')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="languages" data-type="language" data-id="{{$language['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-languages')
                        <tfoot>
                            <tr>
                                <td style="padding: .75rem 0;" colspan="8"><button class="btn btn-danger btn-labeled btn-labeled-right deleteAll" disabled><span>{{translate('common.delete')}}</span><b><i class="icon-bin"></i></b></button></td>
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
        $(function(){
            $('.datatable-order').table(4);
        });
    </script>
@endsection