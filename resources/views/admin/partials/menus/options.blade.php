@foreach($submenus as $submenu)
    @php($preSpace = str_repeat("&emsp;&emsp;",$layer-1))
    <option value="{{$submenu->id}}" {{isset($parent) && $submenu->id===$parent_id?'selected':''}}>{!! $preSpace !!}&mdash;&emsp;{{$submenu->name}}</option>
    @if($submenus = $submenu->submenus)
        @include('admin.partials.menus.options', ['submenus' => $submenus,'layer' => $layer+1])
    @endif
@endforeach
