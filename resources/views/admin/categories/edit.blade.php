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
                    <a href="{{route('admin.categories.index')}}" class="breadcrumb-item">{{translate('breadcrumb.categories')}}</a>
                    <span class="breadcrumb-item active">{{$category['name']}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <div class="content p-0">
        <form action="{{route('admin.categories.update',['category' => $category['id']])}}" method="post" data-reload="reload">
            @csrf
            @method('PUT')
            <div class="card border-top-0 mb-0">
                @if(session()->has('success'))
                    {!! alert(session()->get('success')) !!}
                @endif
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="parent">{{translate('categories.parent')}}</label>
                            <div class="input-group">
                                <select class="form-control select2" id="parent" name="parent">
                                    <option value="null">{{translate('options.noParent')}}</option>
                                    @foreach($categories as $parentCategory)
                                        <option value="{{$parentCategory->id}}" {{$parentCategory->id===$category->parent?'selected':''}}>{{$parentCategory->name}}</option>
                                        @if($subcategories = $parentCategory->subcategories)
                                            @include('admin.partials.categories.options', ['subcategories' => $subcategories,'layer' => 1,'parent_id' => $category->parent])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('parent_id'))
                                <div class="text-danger">{{$errors->first('parent_id')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="name">{{translate('categories.name')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="name" name="name" value="{{$category->name}}">
                            </div>
                            @if($errors->has('name'))
                                <div class="text-danger">{{$errors->first('name')}}</div>
                            @endif
                        </div>


                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="description">{{translate('categories.description')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="description" name="description" value="{{$category->description}}">
                            </div>
                            @if($errors->has('description'))
                                <div class="text-danger">{{$errors->first('description')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label for="order">{{translate('categories.order')}}</label>
                            <div class="input-group">
                                <input class="form-control" id="order" name="order" value="{{$category->order}}">
                            </div>
                            @if($errors->has('order'))
                                <div class="text-danger">{{$errors->first('order')}}</div>
                            @endif
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="status">{{translate('categories.status')}}</label>
                            <div class="input-group">
                                <input class="form-control switchery" id="status" type="checkbox" name="status" {{$category['status']?'checked':''}}>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button class="btn bg-slate submitAJAX">{{translate('categories.editCategory')}}</button>
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
