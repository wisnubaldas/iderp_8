<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>
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
            {{-- <li class="active">
                <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Other Pages</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="search_results.html">Search results</a></li>
                    <li><a href="lockscreen.html">Lockscreen</a></li>
                    <li><a href="invoice.html">Invoice</a></li>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="login_two_columns.html">Login v.2</a></li>
                    <li><a href="forgot_password.html">Forget password</a></li>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="404.html">404 Page</a></li>
                    <li><a href="500.html">500 Page</a></li>
                    <li class="active"><a href="empty_page.html">Empty page</a></li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>