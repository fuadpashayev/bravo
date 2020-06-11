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
                    <a href="{{route('admin.offers.index')}}" class="breadcrumb-item">{{translate('breadcrumb.offers')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.newOffer')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.offers.store')}}" method="post" data-reload="{{route('admin.offers.index')}}">
            @csrf
            <div class="card border-top-0 mb-0 border-x-0">
                <div class="card-body">
                    <div class="row">


                        <div class="form-group col-lg-5 col-md-5 col-sm-12">
                            <label for="title"><i class="icon-pencil title-icon"></i>{{translate('offers.title')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="title"  name="title">
                            </div>
                        </div>

                        <div class="form-group col-lg-5 col-md-5 col-sm-12">
                            <label for="text"><i class="icon-file-text title-icon"></i>{{translate('offers.text')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="text"  name="text">
                            </div>
                        </div>

                        <div class="form-group col-lg-2 col-md-2 col-sm-6">
                            <label for="status"><i class="icon-file-check title-icon"></i>{{translate('offers.status')}}</label>
                            <div class="input-group" style="padding: 7px 7px 7px 0;">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" checked>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-6">
                            <div class="btn bg-slate" id="openMediaManager" data-media-title="true" data-type="titleAndText"><i class="icon-gallery"></i> {{translate('media.openMediaManager')}}</div>
                            <div class="media-area row">
                                <input type="hidden" id="media" name="media">
                                <empty><i class="icon-files-empty title-icon"></i>{{translate('common.nothingSelected')}}</empty>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('offers.addNewOffer')}}</button>
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
                let newMediaTitleTextInput = `<input type="hidden" name="mediaTitles[${mediaId}]" value="${mediaTitle}"/>`;
                newMediaTitleTextInput += `<input type="hidden" name="mediaTexts[${mediaId}]" value="${mediaTexts[mediaId]}"/>`;
                $('form').append(newMediaTitleTextInput);
            });
        }

        $('select.select2').select2();
    </script>
@endsection
