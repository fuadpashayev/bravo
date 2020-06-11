@extends('admin.layouts.layout')


@section('styles')
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
        #infos .row {
            border-bottom: 1px solid #ebebeb;
            margin: 10px 0;
        }
        #infos .row:last-child {
            border-bottom: 0;
        }
        .select2-selection--multiple .select2-search--inline:first-child .select2-search__field {
            padding-left: .5rem;
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
                    <a href="{{route('admin.menus.index')}}" class="breadcrumb-item">{{translate('breadcrumb.menus')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.newMenu')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.menus.store')}}" method="post" data-reload="reload">
            @csrf
            <div class="card border-top-0 mb-0">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="parent_id">{{translate('menus.parent')}}</label>
                            <div class="input-group">
                                <select class="form-control select2" id="parent_id" name="parent_id">
                                    <option value="null">{{translate('options.noParent')}}</option>
                                    @foreach($menus as $parentMenu)
                                        <option value="{{$parentMenu->id}}">{{$parentMenu->name}}</option>
                                        @if($submenus = $parentMenu->subMenus)
                                            @include('admin.partials.menus.options', ['submenus' => $submenus,'layer' => 1])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('parent_id'))
                                <div class="text-danger">{{$errors->first('parent_id')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('menus.name')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="description">{{translate('menus.description')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="description" name="description">
                            </div>
                            @if($errors->has('description'))
                                <div class="text-danger">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="target">{{translate('menus.target')}}</label>
                            <div class="input-group">
                                <select name="target[]" id="target" class="form-control selectpicker" data-container="body" multiple data-live-search="true" data-selected-text-format="count">
                                    @foreach(config('settings.menuTargets') as $target)
                                        <option value="{{$target}}">{{translate("menus.$target")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('target'))
                                <div class="text-danger">{{$errors->first('target')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="url">{{translate('menus.url')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="url" name="url"/>
                            </div>
                            @if($errors->has('url'))
                                <div class="text-danger">{{$errors->first('url')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="order">{{translate('menus.order')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="order" name="order" value="{{getLastOrder('menus')}}">
                            </div>
                            @if($errors->has('order'))
                                <div class="text-danger">{{$errors->first('order')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="status">{{translate('menus.status')}}</label>
                            <div class="input-group" style="padding: 7px 7px 7px 0;">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" checked>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('menus.newMenu')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            $('select.select2').select2();
            $('select.selectpicker').selectpicker();
            $('.form-check-input-styled').uniform();
            $('.switchery').each(function(){new Switchery($(this)[0])});
        });

        $(document).on('change','#parent_id',function(){
            let column = 'parent_id';
            let value = $(this).val();
            let model = 'Menu';
            pashayev.request({
                url: '{{route('admin.generateOrderNumberInParent')}}',
                input: {column,value,model},
                success: function(response){
                    $('#order').val(response.result.order);
                }
            });
        });
    </script>
@endsection
