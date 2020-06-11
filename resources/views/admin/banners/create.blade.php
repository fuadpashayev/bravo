@extends('admin.layouts.layout')


@section('styles')
    <style>

    </style>
@endsection

@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                    <a href="{{route('admin.banners.index')}}" class="breadcrumb-item">{{translate('breadcrumb.banners')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.newBanner')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.banners.store')}}" method="post" data-reload="{{route('admin.banners.index')}}">
            @csrf
            <div class="card border-top-0 mb-0 border-x-0">
                <div class="card-body">
                    <div class="row">


                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="title"><i class="icon-pencil title-icon"></i>{{translate('banners.title')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="title"  name="title">
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="text"><i class="icon-typography title-icon"></i>{{translate('banners.text')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="text"  name="text">
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="url"><i class="icon-hyperlink title-icon"></i>{{translate('banners.url')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="url"  name="url">
                            </div>
                        </div>

                        <div class="form-group col-lg-5 col-md-5 col-sm-5">
                            <label for="target"><i class="icon-align-left title-icon"></i>{{translate('banners.target')}}</label>
                            <div class="input-group">
                                <select name="target" id="target" class="form-control select2">
                                    @foreach(config('settings.bannerTargets') as $target)
                                        <option value="{{$target}}">{{translate("banners.$target")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('target'))
                                <div class="text-danger">{{$errors->first('target')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-5 col-md-5 col-sm-5">
                            <label for="style"><i class="icon-design title-icon"></i>{{translate('banners.style')}}</label>
                            <div class="input-group">
                                <select name="style" id="style" class="form-control select2">
                                    @foreach(config('settings.bannerStyles') as $style)
                                        <option value="{{$style}}">{{translate("styles.$style")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('style'))
                                <div class="text-danger">{{$errors->first('style')}}</div>
                            @endif
                        </div>


                        <div class="form-group col-lg-2 col-md-2 col-sm-2">
                            <label for="status"><i class="icon-file-check title-icon"></i>{{translate('banners.status')}}</label>
                            <div class="input-group" style="padding: 7px 7px 7px 0;">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" checked>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="btn bg-slate" id="openMediaManager" data-media-select-type="single" data-media-title="true"><i class="icon-gallery"></i> {{translate('media.openMediaManager')}}</div>
                            <div class="media-area row">
                                <input type="hidden" id="media" name="media">
                                <empty><i class="icon-files-empty title-icon"></i>{{translate('common.nothingSelected')}}</empty>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('banners.addNewBanner')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            $('#target').trigger('change');
            $('select.select2').select2();
        });

        $(document).on('change','#target',function(){
           let column = 'target';
           let value = $(this).val();
           let model = 'Banner';
           pashayev.request({
               url: '{{route('admin.generateOrderNumberInParent')}}',
               input: {column,value,model},
               success: function(response){
                   $('#order').val(response.result.order);
               }
           });
        });

        function beforeSubmit(){
            Object.entries(mediaTexts).forEach(([mediaId,mediaText]) => {
                let newMediaTextInput = `<input type="hidden" name="media_texts[${mediaId}]" value="${mediaText}"/>`;
                $('form').append(newMediaTextInput);
            });
        }

    </script>
@endsection
