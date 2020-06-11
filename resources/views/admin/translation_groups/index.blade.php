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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.translationGroups')}}</span>
                </div>
            </div>
            @permission('create-translation-groups')
                <div class="text-right">
                    <a href="{{route('admin.translation_groups.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addTranslationGroup')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-basic dataTable no-footer" data-model="translation_groups" width="100%">
                    <thead>
                        <tr>
                            @permission('delete-translation-groups')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.name')}}</th>
                            <th>{{translate('table.description')}}</th>
                            <th>{{translate('table.status')}}</th>
                            @permission('update-translation-groups|delete-translation-groups')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($translation_groups as $translation_group)
                            <tr>
                                @permission('delete-translation-groups')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$translation_group['id']}}"></td>
                                @endpermission
                                <td>{{$translation_group['id']}}</td>
                                <td>{{$translation_group['name']}}</td>
                                <td>{{$translation_group['description']}}</td>
                                <td>{!! getStatus($translation_group['status']) !!}</td>
                                @permission('update-translation-groups|delete-translation-groups')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-translation-groups')
                                                <a href="{{route('admin.translation_groups.edit',['translation_group' => $translation_group['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-translation-groups')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="translation_groups" data-type="translation group" data-id="{{$translation_group['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-translation-groups')
                        <tfoot>
                            <tr>
                                <td style="padding: .75rem 0;" colspan="6"><button class="btn btn-danger btn-labeled btn-labeled-right deleteAll" disabled><span>{{translate('common.delete')}}</span><b><i class="icon-bin"></i></b></button></td>
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