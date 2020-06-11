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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.banners')}}</span>
                </div>
            </div>
            @permission('create-banners')
                <div class="text-right">
                    <a href="{{route('admin.banners.create')}}" class="btn btn-labeled btn-labeled-right bg-slate">{{translate('breadcrumb.addBanner')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-posts dataTable no-footer" data-model="banners" width="100%">
                    <thead>
                        <tr>
                            <th class="no-sort sorting_disabled" style=""></th>
                            <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.title')}}</th>
                            <th>{{translate('table.text')}}</th>
                            <th>{{translate('table.target')}}</th>
                            <th>{{translate('table.style')}}</th>
                            <th>{{translate('table.author')}}</th>
                            <th>{{translate('table.order')}}</th>
                            <th>{{translate('table.status')}}</th>
                            @permission('update-banners|delete-banners')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody class="drag-container" id="drag-dragger">
                        @foreach($banners as $banner)
                            <tr id="{{$banner->id}}">
                                <td style="width: 30px;padding:0 0 0 1.25rem"><i class="icon-move dragula-handle"></i></td>
                                <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$banner->id}}"></td>
                                <td>{{$banner->id}}</td>
                                <td>{{$banner->title}}</td>
                                <td>{{$banner->text}}</td>
                                <td>{{translate("targets.$banner->target")}}</td>
                                <td>{{translate("styles.$banner->target")}}</td>
                                <td>{{$banner->author->name}}</td>
                                <td>{{$banner->order}}</td>
                                <td>{!! getStatus($banner->status) !!}</td>

                                @permission('update-banners|delete-banners')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-banners')
                                                <a href="{{route('admin.banners.edit',['banner' => $banner->id])}}" class="dropdown-item mr-0"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-banners')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="banners" data-type="banner" data-id="{{$banner->id}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-banners')
                        <tfoot>
                            <tr>
                                <td style="padding: .75rem 0;" colspan="11"><button class="btn btn-danger btn-labeled btn-labeled-right deleteAll" disabled><span>{{translate('common.delete')}}</span><b><i class="icon-bin"></i></b></button></td>
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
            $('.datatable-posts').table(7,'asc');
            let drag = dragula([document.getElementById('drag-dragger')], {
                mirrorContainer: document.querySelector('.drag-container')
            });

            drag.on('dragend',function(){
                let reorders = {};
                $('tbody tr').each((order,element) => {
                    let dataId = $(element).attr('id');
                    order++;
                    reorders[dataId] = order;
                });
                pashayev.startLoader();
                pashayev.request({
                    url:'{{route('admin.reorder')}}',
                    input:{
                        reorders,
                        model:'Banner'
                    },
                    success:function(response){
                        pashayev.notify({
                            type:'success',
                            text:response.message
                        });
                        pashayev.stopLoader();
                    }
                });

            });

        });
    </script>
@endsection
