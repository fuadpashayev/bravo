@extends('admin.layouts.layout')


@section('styles')
    <style>

    </style>
@endsection

@section('content')

    @php
        $pageData = null;
        foreach ($pages as $page){$pageData = $page;}

    @endphp
    <!-- Page header -->
    <div class="page-header page-header-light" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                    <a href="{{route('admin.pages.index')}}" class="breadcrumb-item">{{translate('breadcrumb.pages')}}</a>
                    <span class="breadcrumb-item active">{{$pageData->title}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.pages.update',['page' => $pageData->page_id])}}" method="POST" data-reload="{{route('admin.pages.index')}}">
            @csrf
            @method('PUT')
            <div class="card border-top-0 mb-0 border-x-0">
                @if(session()->has('success'))
                    {!! alert(session()->get('success')) !!}
                @endif
                <div class="card-body px-0">
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        @foreach(getLanguages() as $language)
                            <li class="nav-item"><a href="#tab-{{$language['key']}}" class="nav-link {{getLocale()===$language['key']?'active':''}}" data-toggle="tab">{{$language['name']}}</a></li>
                        @endforeach
                        <li class="nav-item"><a href="#tab-gallery" class="nav-link" data-toggle="tab">{{translate('tabs.gallery')}}</a></li>
                        <li class="nav-item"><a href="#tab-settings" class="nav-link" data-toggle="tab">{{translate('tabs.settings')}}</a></li>
                    </ul>


                    <div class="tab-content px-3">
                        @foreach(getLanguages() as $language)
                            @php($page = $pages[$language['key']]??null)
                            <div class="tab-pane fade {{getLocale()===$language['key']?'active show':''}}" id="tab-{{$language['key']}}">
                                <div class="row">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="title-{{$language['key']}}"><i class="icon-pencil5 title-icon"></i>{{translate('pages.title')}}</label>
                                        <input class="form-control" id="title-{{$language['key']}}" name="title[{{$language['key']}}]" value="{{$page->title??''}}">
                                        @if($errors->has('title'))
                                            <div class="text-danger">{{$errors->first('title')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="content-{{$language['key']}}"><i class="icon-file-text title-icon"></i>{{translate('pages.content')}}</label>
                                        <textarea class="form-control page-content-data" id="content-{{$language['key']}}" name="content[{{$language['key']}}]">{{$page->content??''}}</textarea>
                                        @if($errors->has('content'))
                                            <div class="text-danger">{{$errors->first('content')}}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="slug-{{$language['key']}}"><i class="icon-hyperlink title-icon"></i>{{translate('pages.slug')}}</label>
                                        <input class="form-control" id="slug-{{$language['key']}}" name="slug[{{$language['key']}}]" value="{{$page->slug??''}}">
                                        @if($errors->has('slug'))
                                            <div class="text-danger">{{$errors->first('slug')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="tab-pane fade" id="tab-gallery">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="btn bg-slate" id="openMediaManager"><i class="icon-gallery"></i> {{translate('media.openMediaManager')}}</div>
                                    <div class="media-area row">
                                        <input type="hidden" id="media" name="media" value="{{$pageData->media}}">
                                        @if($medias = \App\Page::getMedia($pageData->page_id))
                                            @foreach($medias as $media)
                                                <a href="{{$media->url}}" class="fancybox" data-fancybox="media">
                                                    <div class="image" id="{{$media->id}}">
                                                        <img src="{{$media->url}}"/>
                                                        <div class="action deleteMedia">×</div>
                                                        <div class="action editMedia"><i class="icon-pencil"></i></div>
                                                        <div class="action showMedia"><i class="icon-eye"></i></div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <empty><i class="icon-files-empty title-icon"></i>{{translate('common.nothingSelected')}}</empty>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-settings">
                            <div class="row">
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="menu"><i class="icon-grid-alt title-icon"></i>{{translate('pages.menu')}}</label>
                                        <div class="input-group">
                                            <select class="form-control" id="menu" name="menu">
                                                <option value="">{{translate('common.selectMenu')}}</option>
                                                @foreach($menus as $parentMenu)
                                                    <option value="{{$parentMenu->id}}" {{$pageData->menu_id===$parentMenu->id?'selected':''}}>{{$parentMenu->name}}</option>
                                                    @if($submenus = $parentMenu->subMenus)
                                                        @include('admin.partials.menus.options', ['submenus' => $submenus,'layer' => 1])
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->has('menu'))
                                            <div class="text-danger">{{$errors->first('menu')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <label for="date"><i class="icon-calendar3 title-icon"></i>{{translate('pages.date')}}</label>
                                        <div class="input-group">
                                            <input class="form-control" id="date" name="date" value="{{humanDate($pageData->date)}}">
                                        </div>
                                        @if($errors->has('date'))
                                            <div class="text-danger">{{$errors->first('date')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-lg-12 col-md-12 col-sm-12 pl-3">
                                    <label for="status"><i class="icon-file-check title-icon"></i>{{translate('pages.status')}}</label>
                                    <div class="input-group">
                                        <input class="form-control switchery" id="status" type="checkbox" name="status" {{$pageData->status?'checked':''}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('users.editPage')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        appendedMedias = {!! $pageData->media !!};
        $('.page-content-data').each(function(){
            pashayev.editor($(this).attr('id'));
        });
        $('#date').daterangepicker({
            locale: {
                format: 'DD.MM.YYYY HH:mm:ss'
            },
            singleDatePicker: true,
            timePicker: true,
            startDate: moment(),
            timePicker24Hour: true,
            autoUpdateInput: false,
            autoApply: true
        },function(date){
            $('#date').val(date.format('DD.MM.YYYY HH:mm:ss'));
        });
        $("#date").data('daterangepicker').setStartDate($('#date').val());

        $('#menu').select2();

        CKEDITOR.on('instanceReady', function(){
            $.each( CKEDITOR.instances, function(instance) {
                CKEDITOR.instances[instance].on("change", function(e) {
                    for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                });
            });
        });

        $(document).on('change','[id*=title]',function(){
            let text = $(this).val();
            let slugInput = $(this).parents('.row').find('[id*=slug]');
            $.post('{{route('admin.generateSlug')}}',{text},function(slug){
                slugInput.val(slug);
            })
        });
    </script>
@endsection
