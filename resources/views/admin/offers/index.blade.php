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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.offers')}}</span>
                </div>
            </div>
            @permission('create-offers')
                <div class="text-right">
                    <a href="{{route('admin.offers.create')}}" class="btn btn-labeled btn-labeled-right bg-slate">{{translate('breadcrumb.addOffer')}} <b><i class="icon-plus2"></i></b></a>
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
                <table class="table datatable-posts dataTable no-footer" data-model="offers" width="100%">
                    <thead>
                        <tr>
                            <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.title')}}</th>
                            <th>{{translate('table.text')}}</th>
                            <th>{{translate('table.author')}}</th>
                            <th>{{translate('table.status')}}</th>
                            @permission('update-offers|delete-offers')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offers as $offer)
                            <tr>
                                <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$offer->id}}"></td>
                                <td>{{$offer->id}}</td>
                                <td>{{$offer->title}}</td>
                                <td>{{$offer->text}}</td>
                                <td>{{$offer->author->name}}</td>
                                <td>{!! getStatus($offer->status) !!}</td>

                                @permission('update-offers|delete-offers')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-offers')
                                                <a href="{{route('admin.offers.edit',['offer' => $offer->id])}}" class="dropdown-item mr-0"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-offers')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="offers" data-type="offer" data-id="{{$offer->id}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        @endforeach
                    </tbody>
                    @permission('delete-offers')
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
