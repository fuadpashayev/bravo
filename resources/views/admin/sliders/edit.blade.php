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
                    <a href="{{route('admin.sliders.index')}}" class="breadcrumb-item">{{translate('breadcrumb.sliders')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.editSlider')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.sliders.update',['slider' => $slider->id])}}" method="post" data-reload="{{route('admin.sliders.index')}}">
            @csrf
            @method('put')
            <div class="card border-top-0 mb-0 border-x-0">
                <div class="card-body">
                    <div class="row">


                        <div class="form-group col-lg-5 col-md-5 col-sm-12">
                            <label for="title"><i class="icon-typography title-icon"></i>{{translate('sliders.title')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="title"  name="title" value="{{$slider->title}}">
                            </div>
                        </div>

                        <div class="form-group col-lg-5 col-md-5 col-sm-6">
                            <label for="target"><i class="icon-align-left title-icon"></i>{{translate('sliders.target')}}</label>
                            <div class="input-group">
                                <select name="target" id="target" class="form-control select2">
                                    @foreach(config('settings.sliderTargets') as $target)
                                        <option value="{{$target}}" {{$slider->target===$target?'selected':''}}>{{translate("sliders.$target")}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('target'))
                                <div class="text-danger">{{$errors->first('target')}}</div>
                            @endif
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-6">
                            <label for="status"><i class="icon-file-check title-icon"></i>{{translate('sliders.status')}}</label>
                            <div class="input-group" style="padding: 7px 7px 7px 0;">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" {{$slider->status?'checked':''}}>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-6">
                            <div class="btn bg-slate" id="openMediaManager"><i class="icon-gallery"></i> {{translate('media.openMediaManager')}}</div>
                            <div class="media-area row">
                                <empty class="d-none"><i class="icon-files-empty title-icon"></i>{{translate('common.nothingSelected')}}</empty>
                                @php($mediaTitles = [])
                                @foreach($subSliders as $subSlider)
                                    @php($mediaTitles[$subSlider->media->id] = $subSlider->title)
                                    <a href="{{$subSlider->media->url}}" class="fancybox" data-fancybox="media" data-caption="{{$subSlider->title}}">
                                        <div class="image" id="{{$subSlider->media->id}}">
                                            @if($subSlider->media->type==='video' && $subSlider->media->mime_type==='youtube')
                                                <iframe src="{{generateYoutubeEmbedUrl($subSlider->media->url)}}"></iframe>
                                            @else
                                                <img src="{{$subSlider->media->url}}" alt="{{$subSlider->title}}"/>
                                            @endif
                                            <div class="action textMedia"><i class="icon-pencil"></i></div>
                                            <div class="action deleteMedia">×</div>
                                            <div class="action editMedia"><i class="icon-crop"></i></div>
                                            <div class="action showMedia"><i class="icon-eye"></i></div>
                                            <div class="caption-area" data-placeholder="{{translate('sliders.enterTitle')}}">{{substr($subSlider->title,0,75)}}</div>
                                            <input type="hidden" name="media[]" value="{{$subSlider->media->id}}">
                                        </div>
                                    </a>
                                @endforeach
                                <script>mediaTitles = {!! json_encode($mediaTitles) !!}</script>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('sliders.editSlider')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>

        function beforeSubmit(){
            Object.entries(mediaTitles).forEach(([mediaId,mediaTitle]) => {
                let newMediaTitleInput = `<input type="hidden" name="mediaTitles[${mediaId}]" value="${mediaTitle}"/>`;
                $('form').append(newMediaTitleInput);
            });
        }

        $('select.select2').select2();
    </script>
@endsection
