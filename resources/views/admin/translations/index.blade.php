@extends('admin.layouts.layout')


@section('styles')
    <style>
        #roles tr, #roles td, #roles th{
            border:1px solid #ebebeb;
            padding: 10px;
        }
        .translations{
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="page-header page-header-light" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline py-2">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{translate('breadcrumb.dashboard')}}</a>
                    <span class="breadcrumb-item active">{{translate('breadcrumb.translations')}}</span>
                </div>
            </div>
            <div class="text-right">
                @permission('export-translations')
                    <a href="{{route('admin.translations.exportView')}}" class="btn btn-labeled btn-labeled-right bg-slate my-1">{{translate('breadcrumb.exportTranslation')}} <b><i class="icon-database-export"></i></b></a>
                @endpermission
                @permission('create-translations')
                    <a href="{{route('admin.translations.create')}}" class="btn btn-labeled btn-labeled-right bg-slate addData">{{translate('breadcrumb.addTranslation')}} <b><i class="icon-plus2"></i></b></a>
                @endpermission
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="content data-index-page p-0">
        <div class="card border-top-0">
            <div class="card-header d-none">
            </div>

            @if(session()->has('success'))
                {!! alert(session()->get('success')) !!}
            @endif


            <div class="card-body">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 mt-3">
                    <label for="translationGroup">{{translate('translations.group')}}</label>
                    <div class="input-group">
                        <select class="form-control select2" id="translationGroup" name="group">
                            <option value="-1">{{translate('options.selectTranslationGroup')}}</option>
                            @foreach($translation_groups as $translation_group)
                                <option value="{{$translation_group['id']}}">{{ucfirst($translation_group['name'])}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="translations">
                    <table class="table translationTable dataTable no-footer" data-model="translations" width="100%">
                        <thead>
                        <tr>
                            @permission('delete-translations')
                                <th class="no-sort sorting_disabled" style="width: 20px;"><input type="checkbox" class="selectAll form-check-input-styled" data-target="selecteds"></th>
                            @endpermission
                            <th style="width: 100px">ID</th>
                            <th>{{translate('table.key')}}</th>
                            <th>{{translate('table.value')}}</th>
                            @permission('update-translations|delete-translations')
                                <th class="text-center no-sort" style="width: 100px">{{translate('table.actions')}}</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody></tbody>
                        @permission('delete-translations')
                            <tfoot>
                                <tr>
                                    <td style="padding: .75rem 0;" colspan="5"><button class="btn btn-danger btn-labeled btn-labeled-right deleteAll" disabled><span>{{translate('common.delete')}}</span><b><i class="icon-bin"></i></b></button></td>
                                </tr>
                            </tfoot>
                        @endpermission
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).on('change','#translationGroup',function(){
            let group = $(this).val();
            if(group!=="-1"){
                pashayev.startLoader();
                $('.translations').fadeOut(300);
                $.get(`translation_group/${group}/translations`,function(translations){
                    let linkElement = $('.addData');
                    let url = linkElement.attr('href').split('create');
                    url.splice(-1);
                    url.push(group);
                    url = url.join('create/');
                    linkElement.attr('href',url);
                    let rows = '';
                    translations.forEach(function(translation){
                        rows += `
                            <tr>
                                @permission('delete-translations')
                                    <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="${translation.id}"></td>
                                @endpermission
                                <td>${translation.id}</td>
                                <td>${translation.translationGroup}.${translation.key}</td>
                                <td>${pashayev.translate(`${translation.translationGroup}.${translation.key}`)}</td>
                                @permission('update-translations|delete-translations')
                                    <td class="text-center">
                                        <div class="list-icons">
                                            @permission('update-translations')
                                                <a href="/admin/translations/${translation.id}/edit" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                                            @endpermission
                                            @permission('delete-translations')
                                                <a data-false class="dropdown-item mr-0 delete" data-model="translations" data-type="translation" data-id="${translation.id}"><i class="icon-bin mr-0 text-danger"></i> </a>
                                            @endpermission
                                        </div>
                                    </td>
                                @endpermission
                            </tr>
                        `;
                    });
                    $('.translationTable').DataTable().clear().destroy();
                    $('.translationTable tbody').html(rows);
                    $('.translations').fadeIn(300);
                    $('.form-check-input-styled').uniform();
                    pashayev.stopLoader();
                    DatatableBasic.initManually('.translationTable');
                });
            }
        });
        $('select.select2').select2();
        let groupHash = window.location.hash;
        if(groupHash){
            groupHash = groupHash.replace(/[^\d]/i,'');
            $('#translationGroup').val(groupHash).trigger('change')
        }
    </script>
@endsection
