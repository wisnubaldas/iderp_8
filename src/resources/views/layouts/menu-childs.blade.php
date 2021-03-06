@foreach($childs as $child)
    @if(isset($child->childs))
        <li class="{{isset($active)?'active':''}}">
            <a href="{{$child->url}}">
                <i class="{{$child->icon}}"></i> 
                    <span class="nav-label">{{$child->title}}</span>
                    <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
                @include('layouts.menu-childs',['childs' => $child->childs])
            </ul>
        </li>
    @else
        <li class="{{isset($active)?'active':''}}">
            <a href="{{url($child->url)}}">
                {{$child->title}}
            </a>
        </li>
    @endif
@endforeach