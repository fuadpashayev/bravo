@php($color = generateHEXColor($existColors))
@foreach($submenus as $submenu)
    @php($preSpace = str_repeat("&emsp;&emsp;",$layer-1))
    <tr>
        @permission('delete-menus')
        <td><input type="checkbox" class="form-check-input-styled" name="selecteds" value="{{$submenu['id']}}"></td>
        @endpermission
        <td>{{$submenu['id']}}</td>
        <td>{!! $preSpace !!}&mdash;&emsp;{{$submenu['name']}}</td>
        <td>{{$submenu['description']}}</td>
        <td>{{$menu->url}}</td>
        <td>
            @foreach(json_decode($menu->target) as $target)
                <div class="badge bg-slate">{{translate("menus.$target")}}</div>
            @endforeach
        </td>
        <td>{!! $preSpace !!}&mdash;&emsp;<span class="p-1 text-white rounded" style="background-color:#{{$color}}">{{$submenu['order']}}</span></td>
        <td>{!! getStatus($submenu['status']) !!}</td>
        @permission('update-menus|delete-menus')
        <td class="text-center">
            <div class="list-icons">
                @permission('update-menus')
                    <a href="{{route('admin.menus.edit',['menu' => $submenu['id']])}}" class="dropdown-item mr-0 editData"><i class="icon-pencil mr-0 text-slate"></i> </a>
                @endpermission
                @permission('delete-menus')
                    <a data-false class="dropdown-item mr-0 delete" data-model="menus" data-type="menu" data-id="{{$submenu['id']}}"><i class="icon-bin mr-0 text-danger"></i> </a>
                @endpermission
            </div>
        </td>
        @endpermission
    </tr>

    @if($submenus = $submenu->submenus)
        @php($existColors[] = $color)
        @include('admin.partials.menus.table', ['submenus' => $submenus,'layer' => $layer+1,'existColors' => $existColors])
    @endif
@endforeach
