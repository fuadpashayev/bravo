@php($color = generateHEXColor($existColors))
@foreach($subcategories as $subcategory)
    @php($preSpace = str_repeat("&emsp;&emsp;",$layer-1))
    <tr>
        @permission('delete-categories')
        <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$subcategory['id']}}"></td>
        @endpermission
        <td>{{$subcategory['id']}}</td>
        <td>{!! $preSpace !!}&mdash;&emsp;{{$subcategory['name']}}</td>
        <td>{{$subcategory['description']}}</td>
        <td>{!! $preSpace !!}&mdash;&emsp;<span class="p-1 text-white rounded" style="background-color:#{{$color}}">{{$subcategory['order']}}</span></td>
        <td>{!! getStatus($subcategory['status']) !!}</td>
        @permission('update-categories|delete-categories')
        <td class="text-center">
            <div class="list-icons">
                @permission('update-categories')
                    <a href="{{route('admin.categories.edit',['category' => $subcategory['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                @endpermission
                @permission('delete-categories')
                    <a data-false class="dropdown-item mr-0 delete" data-model="category" data-type="category" data-id="{{$subcategory['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                @endpermission
            </div>
        </td>
        @endpermission
    </tr>

    @if($subcategories = $subcategory->subcategory)
        @php($existColors[] = $color)
        @include('admin.partials.categories.table', ['subcategories' => $subcategories,'layer' => $layer+1,'existColors' => $existColors])
    @endif
@endforeach
