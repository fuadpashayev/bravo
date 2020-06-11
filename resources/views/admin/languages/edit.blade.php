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
                    <a href="{{route('admin.languages.index')}}" class="breadcrumb-item">{{translate('breadcrumb.languages')}}</a>
                    <span class="breadcrumb-item active">{{$language['name']}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.languages.update',['language' => $language['id']])}}" method="post" data-reload="reload">
            @csrf
            @method('PUT')
            <div class="card border-top-0 mb-0">
                @if(session()->has('success'))
                    {!! alert(session()->get('success')) !!}
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="key">{{translate('languages.key')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="key" name="key" value="{{$language['key']}}">
                            </div>
                            @if($errors->has('key'))
                                <div class="text-danger">{{$errors->first('key')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('languages.name')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name" value="{{$language['name']}}">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="description">{{translate('languages.description')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="description" name="description" value="{{$language['description']}}">
                            </div>
                            @if($errors->has('description'))
                                <div class="text-danger">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="order">{{translate('languages.order')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="order" name="order" value="{{$language['order']}}">
                            </div>
                            @if($errors->has('order'))
                                <div class="text-danger">{{$errors->first('order')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="status">{{translate('languages.status')}}</label>
                            <div class="input-group">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" {{$language['status']?'checked':''}}>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('languages.editLanguage')}}</button>
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
        });
    </script>
@endsection
