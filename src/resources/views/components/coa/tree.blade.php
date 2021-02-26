@foreach($children as $child)
    @if(isset($child['children']))
        <ul>
            <li data-jstree='"type":"css"}' id="{{$child['coa_id']}}">
                {{$child['coa_id']}} - <span class="text-success">{{$child['coa_name']}}</span> 
                @include('components.coa.tree',['children' => $child['children']])
            </li>
        </ul>
    @else
        <ul>
            <li data-jstree='"type":"css"}' id="{{$child['coa_id']}}">{{$child['coa_id']}} - <span class="text-success">{{$child['coa_name']}}</span> </li>
        </ul>
    @endif
@endforeach