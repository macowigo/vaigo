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
            <li class="bold waves-effect"><a class="collapsible-header">Orders<i class="material-icons">subtitles</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('orders.create') }}" class="waves-effect">Create Order<i class="material-icons">post_add</i></a></li>
                        <li><a href="{{route('domesticorder')}}" class="waves-effect">Domestic Orders<i class="material-icons">home</i></a></li>
                        <li><a href="{{route('regionalorder')}}" class="waves-effect">Regional Orders<i class="material-icons">apartment</i></a></li>
                        <li><a href="{{route('internationalorder')}}" class="waves-effect">International Orders<i class="material-icons">language</i></a></li>
                        <li><a href="{{route('orders.index')}}" class="waves-effect">Manage Orders<i class="material-icons">construction</i></a></li>
                    </ul>
                </div>
            </li>
         <li>
         <a href="" class="waves-effect">ChangePassword<i class="material-icons">lock</i></a>
         </li> 
         <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a :href="route('logout')" class="waves-effect red-text"
                onclick="event.preventDefault();this.closest('form').submit();">
                <i class="material-icons red-text">logout</i>
                LogOut
                </a>
            </form>
        </li>
        </ul>
    </li>
</ul>

<div id="chat-dropdown" class="dropdown-content dropdown-tabbed">
    <div  class="col s12">
        <ul class="collection flush">
            <li>
                <a href="change_password" class="waves-effect blue-text">Change Password
                    <i class="material-icons blue-text">lock</i>
              </a>
            </li>
            <li>

                <a href="logout" class="waves-effect red-text">logout
                    <i class="material-icons red-text">logout</i>
              </a>
            </li>
        </ul>
    </div>
</div>

           