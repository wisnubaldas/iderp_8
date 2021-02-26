<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{url('img/profile_small.jpg')}}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ Auth::user()->name }}</span>
                        <span class="text-muted text-xs block">{{ Auth::user()->email }} <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Contacts</a></li>
                        <li><a class="dropdown-item" href="#">Mailbox</a></li>
                        {{-- <li class="dropdown-divider"></li> --}}
                        <li><form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline btn-danger btn-block">
                                <i class="fa fa-sign-out"></i> Log out
                            </button>
                        </form></li>
                        
                    </ul>
                </div>
                <div class="logo-element">
                    CJFI
                </div>
            <li class="special_link">
                <a href="/"><i class="fa fa-database"></i> <span class="nav-label">Home</span></a>
            </li>
            @foreach ($master['menu'] as $i)
                @if (isset($i->childs))
                    <li >
                        <a href="{{$i->url}}">
                            <i class="{{$i->icon}}"></i> 
                                <span class="nav-label">{{$i->title}}</span>
                                <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            @include('layouts.menu-childs',['childs' => $i->childs])
                        </ul>
                    </li>
                @else
                <li >
                    <a href="{{url($i->url)}}">
                        <i class="{{$i->icon}}"></i> 
                            <span class="nav-label">{{$i->title}}</span>
                            {{-- <span class="fa arrow"></span> --}}
                    </a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>