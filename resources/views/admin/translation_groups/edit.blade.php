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
                    <a href="{{route('admin.translation_groups.index')}}" class="breadcrumb-item">{{translate('breadcrumb.translationGroups')}}</a>
                    <span class="breadcrumb-item active">{{$translation_group['name']}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.translation_groups.update',['translation_group' => $translation_group['id']])}}" method="post" data-reload="reload">
            @csrf
            @method('PUT')
            <div class="card border-top-0 mb-0">
                @if(session()->has('success'))
                    {!! alert(session()->get('success')) !!}
                @endif
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('translationGroups.name')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name" value="{{$translation_group['name']}}">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="description">{{translate('translationGroups.description')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="description" name="description" value="{{$translation_group['description']}}">
                            </div>
                            @if($errors->has('description'))
                                <div class="text-danger">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="status">{{translate('translationGroups.status')}}</label>
                            <div class="input-group">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" {{$translation_group['status']?'checked':''}}>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('translationGroups.editTranslationGroup')}}</button>
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