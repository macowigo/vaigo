<div class="navbar-fixed">
    <nav class="navbar">
        <div class="nav-wrapper">
            <a  class="brand-logo white-text text-darken-4">{{Auth::user()->name}}</a>
            <ul id="nav-mobile" class="right">
                <li>
                    <a href="#!" data-target="chat-dropdown" class="dropdown-trigger waves-effect">
                         <img class="user-image" src="../Uploads/vaigo.png" alt="">
                     </a>
               </li>
            </ul><a href="#!" data-target="sidenav-left" class="sidenav-trigger left"><i class="material-icons white-text">menu</i></a>
        </div>
    </nav>
</div>
<ul id="sidenav-left" class="sidenav sidenav-fixed">
<li><a href="dashboard" class="logo-container blue-text">V A I G O</a>
<img src="../Images/vaigo.png" class="logo-container ">
</li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            <li><a href="{{route('admindshboard')}}" class="waves-effect">Dashboard<i class="material-icons">web</i></a></li>
        <li class="bold waves-effect"><a class="collapsible-header">Centers<i class="material-icons">adjust</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('addcenter') }}" class="waves-effect">Register Center<i class="material-icons">add_circle</i></a></li>
                        <li><a href="{{route('centerlist')}}" class="waves-effect">View Centers<i class="material-icons">view_list</i></a></li>
                        <li><a href="{{route('centemanage')}}" class="waves-effect">Manage Centers<i class="material-icons">construction</i></a></li>
                        <li><a href="{{ route('locationform') }}" class="waves-effect">Register Agent Location<i class="material-icons">add_circle</i></a></li>
                        <li><a href="{{route('agentlocation')}}" class="waves-effect">View Agent Center Locations<i class="material-icons">support_agent</i></a></li>
                        <li><a href="{{route('manageagentlocation')}}" class="waves-effect">Manage Agent Centers<i class="material-icons">construction</i></a></li>
                    </ul>
                </div>
            </li>
            <li class="bold waves-effect"><a class="collapsible-header">Vendors<i class="material-icons">group</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('vendorform') }}" class="waves-effect">Register Vendor<i class="material-icons">person_add</i></a></li>
                        <li><a href="{{route('vendors')}}" class="waves-effect">View Vendors<i class="material-icons">list</i></a></li>
                        <li><a href="{{route('vendorsmanage')}}" class="waves-effect">Manage Vendors<i class="material-icons">construction</i></a></li>
                    </ul>
                </div>
            </li>
            <li class="bold waves-effect"><a class="collapsible-header">Vaigo Users<i class="material-icons">groups</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('staffform')}}" class="waves-effect">Register New User<i class="material-icons">group_add</i></a></li>
                        <li><a href="{{route('staff')}}" class="waves-effect">View Users<i class="material-icons">group</i></a></li>
                        <li><a href="{{route('manageusers')}}" class="waves-effect">Manage Users<i class="material-icons">construction</i></a></li>
                    </ul>
                </div>
            </li>
            <li class="bold waves-effect"><a class="collapsible-header">Domestic Orders<i class="material-icons">subtitles</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('admdompending')}}" class="waves-effect">Pending Orders<i class="material-icons">pending_actions</i></a></li>
                        <li><a href="{{route('admdomcreated')}}" class="waves-effect">Created Orders<i class="material-icons">add_to_queue</i></a></li>
                        <li><a href="{{route('admdomcancelled')}}" class="waves-effect">Cancel Orders<i class="material-icons">cancel</i></a></li>
                        <li><a href="{{route('admdomdeliver')}}" class="waves-effect">Delivering Orders<i class="material-icons">rotate_right</i></a></li>
                        <li><a href="{{route('admdominc')}}" class="waves-effect">Incomplete Orders<i class="material-icons">incomplete_circle</i></a></li>
                        <li><a href="{{route('admdomcomp')}}" class="waves-effect">Complete Orders<i class="material-icons">task_alt</i></a></li>
                        <li><a href="{{route('admdomestic')}}" class="waves-effect">All Orders<i class="material-icons">select_all</i></a></li>
                    </ul>
                </div>
            </li>
            <li class="bold waves-effect"><a class="collapsible-header">Regional Orders<i class="material-icons">apartment</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('admregionaltoday')}}" class="waves-effect">Today Orders<i class="material-icons">today</i></a></li>
                        <li><a href="{{route('admregionalall')}}" class="waves-effect">All Orders<i class="material-icons">select_all</i></a></li>
                    </ul>
                </div>
            </li>
         <li>
         <a href="{{route('changepass')}}" class="waves-effect">ChangePassword<i class="material-icons">lock</i></a>
         </li> 
         <li>
            <a href="{{route('logout') }}" class="waves-effect red-text">Log Out
                <i class="material-icons red-text">logout</i>
            </a>
        </li>
        </ul>
    </li>
</ul>
<div id="chat-dropdown" class="dropdown-content dropdown-tabbed">
    <div  class="col s12">
        <ul class="collection flush">
            <li>
                <a href="{{route('changepass')}}" class="waves-effect blue-text">Change Password
                    <i class="material-icons blue-text">lock</i>
              </a>
            </li>
            <li>
                <a href="{{route('logout')}}" class="waves-effect red-text">logout
                    <i class="material-icons red-text">logout</i>
              </a>
            </li>
        </ul>
    </div>
</div>

           