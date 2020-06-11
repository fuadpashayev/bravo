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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.sliders')}}</span>
                </div>
            </div>
            @permission('create-sliders')
                <div class="text-right">
                    <a href="{{route('admin.sliders.create')}}" class="btn btn-labeled btn-labeled-right bg-slate">{{translate('breadcrumb.addSlider')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-posts dataTable no-footer" data-model="sliders" width="100%">
                    <thead>
                        <tr>
                            <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.title')}}</th>
                            <th>{{translate('table.target')}}</th>
                            <th>{{translate('table.author')}}</th>
                            <th>{{translate('table.status')}}</th>
                            @permission('update-sliders|delete-sliders')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$slider->id}}"></td>
                                <td>{{$slider->id}}</td>
                                <td>{{$slider->title}}</td>
                                <td>{{translate("menus.$slider->target")}}</td>
                                <td>{{$slider->author->name}}</td>
                                <td>{!! getStatus($slider->status) !!}</td>

                                @permission('update-sliders|delete-sliders')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-sliders')
                                                <a href="{{route('admin.sliders.edit',['slider' => $slider->id])}}" class="dropdown-item mr-0"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-sliders')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="sliders" data-type="slider" data-id="{{$slider->id}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-sliders')
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
        $(function(){
            $('.datatable-posts').table(1,'asc');
        });
    </script>
@endsection
