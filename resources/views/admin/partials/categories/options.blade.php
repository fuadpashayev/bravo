@foreach($subcategories as $subcategory)
    @php($preSpace = str_repeat("&emsp;&emsp;",$layer-1))
    <option value="{{$subcategory->id}}" {{isset($parent) && $subcategory->id===$parent?'selected':''}}>{!! $preSpace !!}&mdash;&emsp;{{$subcategory->name}}</option>
    @if($submenus = $subcategory->subcategories)
        @include('admin.partials.categories.options', ['subcategories' => $subcategories,'layer' => $layer+1])
    @endif
@endforeach
