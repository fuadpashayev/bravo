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
                    <span class="breadcrumb-item active">{{translate('breadcrumb.editBanner')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.banners.update',['banner' => $banner->id])}}" method="post" data-reload="{{route('admin.banners.index')}}">
            @csrf
            @method('put')
            <div class="card border-top-0 mb-0 border-x-0">
                <div class="card-body">
                    <div class="row">


                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="title"><i class="icon-pencil title-icon"></i>{{translate('banners.title')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="title" name="title" value="{{$banner->title}}">
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="text"><i class="icon-typography title-icon"></i>{{translate('banners.text')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="text" name="text" value="{{$banner->text}}">
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="url"><i class="icon-hyperlink title-icon"></i>{{translate('banners.url')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="url" name="url" value="{{$banner->url}}">
                            </div>
                        </div>


                        <div class="form-group col-lg-5 col-md-5 col-sm-5">
                            <label for="target"><i class="icon-align-left title-icon"></i>{{translate('banners.target')}}</label>
                            <div class="input-group">
                                <select name="target" id="target" class="form-control select2">
                                    @foreach(config('settings.bannerTargets') as $target)
                                        <option value="{{$target}}" {{$banner->target===$target?'selected':''}}>{{translate("banners.$target")}}</option>
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
                                        <option value="{{$style}}" {{$banner->style===$style?'selected':''}}>{{translate("styles.$style")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('style'))
                                <div class="text-danger">{{$errors->first('style')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-2 col-md-2 col-sm-6">
                            <label for="status"><i class="icon-file-check title-icon"></i>{{translate('banners.status')}}</label>
                            <div class="input-group" style="padding: 7px 7px 7px 0;">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" {{$banner->status?'checked':''}}>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-6">
                            <div class="btn bg-slate" id="openMediaManager"><i class="icon-gallery"></i> {{translate('media.openMediaManager')}}</div>
                            <div class="media-area row">
                                <empty class="d-none"><i class="icon-files-empty title-icon"></i>{{translate('common.nothingSelected')}}</empty>
                                @if($banner->media)
                                    <a href="{{$banner->media->url}}" class="fancybox" data-fancybox="media">
                                        <div class="image" id="{{$banner->media->id}}">
                                            <img src="{{$banner->media->url}}">
                                            <div class="action deleteMedia">×</div>
                                            <div class="action editMedia"><i class="icon-crop"></i></div>
                                            <div class="action showMedia"><i class="icon-eye"></i></div>
                                            <input type="hidden" name="media[]" value="{{$banner->media->id}}">
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('banners.editBanner')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>

        function beforeSubmit(){
            Object.entries(mediaTexts).forEach(([mediaId,mediaText]) => {
                let newMediaTextInput = `<input type="hidden" name="media_texts[${mediaId}]" value="${mediaText}"/>`;
                $('form').append(newMediaTextInput);
            });
        }

        $('select.select2').select2();
    </script>
@endsection
