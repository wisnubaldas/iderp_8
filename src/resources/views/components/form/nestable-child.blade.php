@foreach($children as $child)
    @if(isset($child['children']))
        <ol class="dd-list">
            <li class="dd-item" data-id="{{$child['coa_id']}}">
                <div class="dd-handle">
                    <span class="float-right"> {{$child['coa_dk']}} </span>
                    <span class="label label-primary">{{$child['coa_id']}}</span> {{$child['coa_nama']}} 
                </div>
                @include('components.form.nestable-child',['children' => $child['children']])
            </li>
        </ol>
    @else
    <ol class="dd-list">
        <li class="dd-item" data-id="{{$child['coa_id']}}">
            <div class="dd-handle">
                <span class="float-right"> {{$child['coa_dk']}} </span>
                <span class="label label-primary">{{$child['coa_id']}}</span> {{$child['coa_nama']}}
            </div>
        </li>
    </ol>
    @endif
@endforeach