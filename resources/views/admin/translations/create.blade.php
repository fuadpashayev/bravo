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
                    <a href="{{route('admin.translations.index')}}" class="breadcrumb-item">{{translate('breadcrumb.translations')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.newTranslation')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.translations.store')}}" method="post" data-reload="/admin/translations#{{$group}}">
            @csrf
            {{--@dd($errors)--}}
            <div class="card border-top-0 mb-0">
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="group">{{translate('translations.group')}}</label>
                            <div class="input-group">
                                <select class="form-control select2" id="group" name="group">
                                    <option value="-1">{{translate('options.selectTranslationGroup')}}</option>
                                    @foreach($translation_groups as $translation_group)
                                        <option value="{{$translation_group['id']}}" {{$group==$translation_group['id']?'selected':''}}>{{ucfirst($translation_group['name'])}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('group'))
                                <div class="text-danger">{{$errors->first('group')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="key">{{translate('translations.key')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="key" name="key">
                            </div>
                            @if($errors->has('key'))
                                <div class="text-danger">{{$errors->first('key')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <label for="{{getLanguage()->key}}">{{getLanguage()->name}}</label>
                            <div class="input-group">
                                <input class="form-control" id="{{getLanguage()->key}}" name="value[{{getLanguage()->key}}]">
                                @if(count(getLanguages())>1)
                                    <div class="input-group-append">
                                        <a data-false title="Translate" class="btn bg-slate translate"><b><i class="icon-transmission"></i></b></a>
                                    </div>
                                @endif
                            </div>
                            @if($errors->has("value[".getLanguage()->key."]"))
                                <div class="text-danger">{{$errors->first("value[".getLanguage()->key."]")}}</div>
                            @endif
                        </div>

                        @foreach($languages as $language)
                            @if($language['key']!=getLanguage()->key)
                                <div class="form-group col-12">
                                    <label for="{{$language->key}}">{{$language->name}}</label>
                                    <div class="input-group">
                                        <input class="form-control" id="{{$language->key}}" name="value[{{$language->key}}]">
                                    </div>
                                    @if($errors->has("value[$language[key]"))
                                        <div class="text-danger">{{$errors->first("value[$language[key]]")}}</div>
                                    @endif
                                </div>
                            @endif
                        @endforeach

                    </div>

                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('translations.addNewTranslation')}}</button>
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

        $('.translate').on('click',function(){
            let url = `{{yandexUrl()}}&text=hello&lang=en-ru`;
        });
    </script>
@endsection
