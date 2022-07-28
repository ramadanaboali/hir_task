
<!--Start topbar header-->
<header class="topbar-nav">
    <nav id="header-setting" class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <form class="search-bar">
                    <input type="text" class="form-control" placeholder="Enter keywords">
                    <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                </form>
            </li>
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">


            <li class="nav-item language">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-language"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('select','en')}}"><li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i>  {{__('app.English')}}</li></a>
                    <a href="{{route('select','ar')}}"><li class="dropdown-item"> <i class="flag-icon flag-icon-eg mr-2"></i> {{__('app.Arabic')}}</li> </a>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile"><img src="{{auth()->user()->avatar != null ? auth()->user()->avatar :'https://via.placeholder.com/110x110'}}" class="img-circle" alt="user avatar"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="javaScript:void();">
                            <div class="media">
                                <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">{{auth()->user()->name}}</h6>
                                    <p class="user-subtitle">{{auth()->user()->email}}</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"> <a href="{{route('users.profile')}}"> <i class="icon-user mr-2"></i> {{__('app.profile')}}</a></li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><a href="{{route('users.changepassword',[auth()->user()->id])}}"><i class="icon-lock mr-2"></i> {{__('app.change_password')}}</a></li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"> <a  href="{{ route('logout') }}"
                                                  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon-power mr-2"></i> {{__('app.auth.Logout')}}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form> </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
