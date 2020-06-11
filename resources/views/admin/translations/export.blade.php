@extends('admin.layouts.layout')


@section('styles')
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/dialog.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/fullscreen.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/3024-night.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/theme-monokai.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/theme-oceanic.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/hint.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/lint.css')}}">
    <link rel="stylesheet" href="{{asset('panel/codemirror/css/matchesonscrollbar.css')}}">
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
        textarea{
            display: none;
        }
        .CodeMirror {
            margin: 10px 0;
            height: 70vh;
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
                    <a href="{{route('admin.translations.index')}}" class="breadcrumb-item">{{translate('breadcrumb.translations')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.exportTranslations')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="content p-0">
        <div class="card border-top-0">
            <div class="card-header d-none">
            </div>

            @if(session()->has('success'))
                {!! alert(session()->get('success')) !!}
            @endif
            <div class="card-body">
                <textarea id="export-data" readonly>{{$data}}</textarea>
                <a href="{{route('admin.translations.export')}}" class="btn btn-labeled btn-labeled-right pull-right bg-slate">{{translate('translations.export')}} <b><i class="icon-database-export"></i></b></a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('panel/codemirror/js/codemirror.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/fullscreen.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/autorefresh.js')}} "></script>
    <script src="{{asset('panel/codemirror/js/xml.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/dialog.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/searchcursor.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/search.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/annotatescrollbar.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/matchesonscrollbar.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/show-hint.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/javascript-hint.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/javascript.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/markdown.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/css.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/lint.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/jshint.min.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/jsonlint.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/json-lint.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/css-lint.js')}}"></script>
    <script src="{{asset('panel/codemirror/js/formatting.js')}}"></script>
    <script>
        $(function(){

            window.editor = CodeMirror.fromTextArea($('#export-data')[0],{
                theme:'oceanic-next',
                mode:{
                    name: 'javascript',
                    json: true
                },
                lineNumbers: true,


            });


            $(document).on('keydown',function(e){
                let key = e.which;
                switch (key) {
                    case 122:
                        e.preventDefault();
                        if(editor.getOption('fullScreen')){
                            editor.setOption("fullScreen", false);
                        }else{
                            editor.setOption("fullScreen", true);
                        }
                    break;

                    case 27:
                        e.preventDefault();
                        editor.setOption("fullScreen", false);
                    break;
                }
            });

        });
    </script>
@endsection