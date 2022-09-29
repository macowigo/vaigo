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

        <li><a href="{{route('dptdashboard')}}" class="waves-effect active">Dashboard<i class="material-icons">web</i></a></li>
        <ul class="collapsible collapsible-accordion">
        <li class="bold waves-effect"><a class="collapsible-header">DOMESTIC ORDERS<i class="material-icons">subtitles</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('departurenew')}}" class="waves-effect">New Orders<i class="material-icons">subtitles</i></a></li>
                        <li><a href="{{route('departurered')}}" class="waves-effect">Departured Orders<i class="material-icons">refresh</i></a></li>
                        <li><a href="{{route('incdptdm')}}" class="waves-effect">Incomplete Orders<i class="material-icons">incomplete_circle</i></a></li>
                        <li><a href="{{route('dmcomplete')}}" class="waves-effect">Complete Orders<i class="material-icons">check_circle</i></a></li>
                        <li><a href="{{route('dmalldpt')}}" class="waves-effect">All Orders<i class="material-icons">select_all</i></a></li>
                        <li><a href="{{route('dptmanage')}}" class="waves-effect">Manage Orders<i class="material-icons">construction</i></a></li>
                    </ul>
                </div>
            </li>
            <li class="bold waves-effect"><a class="collapsible-header">REGIONAL ORDERS<i class="material-icons">apartment</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('regionalnew')}}" class="waves-effect">Created Orders<i class="material-icons">subtitles</i></a></li>
                        <li><a href="{{route('regionalcollected')}}" class="waves-effect">Departure Orders<i class="material-icons">departure_board</i></a></li>
                        <li><a href="{{route('regionalall')}}" class="waves-effect">All Orders<i class="material-icons">select_all</i></a></li>
                        {{-- <li><a href="{{route('dptmanage')}}" class="waves-effect">Manage Orders<i class="material-icons">construction</i></a></li> --}}
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{route('changepass')}}" class="waves-effect">ChangePassword<i class="material-icons">lock</i></a>
            </li>      
            <li>
                <a href="{{route('ondoka') }}" class="waves-effect red-text" >Log Out
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
                <a href="{{route('ondoka')}}" class="waves-effect red-text">logout
                    <i class="material-icons red-text">logout</i>
              </a>
            </li>
        </ul>
    </div>
</div>

           