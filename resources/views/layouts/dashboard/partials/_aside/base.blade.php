<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="{{route('home')}}">
            <img src="{{setting()->logo ? setting()->logo:''}}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">{{__('app.dashboard')}}</h5>
        </a>
    </div>

    <ul class="sidebar-menu">
        <li class="sidebar-header">{{__('app.dashboard')}}</li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.dashboard')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('home')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.dashboard')}}</a></li>

            </ul>
        </li>

           <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.side_bar.auth_control.users')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('users.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.side_bar.auth_control.users')}}</a></li>
                 </ul>
             </li>





        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.states_regions')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('countries.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.country')}}</a></li>
                <li><a href="{{route('states.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.states')}}</a></li>
                <li><a href="{{route('regions.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.regions')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.partners')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('partners.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.partners')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.rooms')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('rooms.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.rooms')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.devices')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('devices.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.devices')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.sliders')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('sliders.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.sliders')}}</a></li>
            </ul>
        </li>
        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.notifications')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('notifications.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.notifications')}}</a></li>

                <li><a href="{{route('contacts.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.contacts')}}</a></li>
            </ul>
        </li>


        <li>
            <a href="javaScript:void();" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>{{__('app.side_bar.settings_controller')}}</span><i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="sidebar-submenu">
                <li><a href="{{route('infos.index')}}"><i class="zmdi zmdi-dot-circle-alt"></i> {{__('app.side_bar.settings_controller')}}</a></li>
            </ul>
        </li>

       </ul>

</div>
<!--End sidebar-wrapper-->
