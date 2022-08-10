<div class="navbar-fixed">
    <nav class="navbar">
        <div class="nav-wrapper">
            <a  class="brand-logo white-text text-darken-4">{{Auth::user()->name}}</a>
            <ul id="nav-mobile" class="right">
                <li>
                    <a href="#!" data-target="chat-dropdown" class="dropdown-trigger waves-effect">
                         <img class="user-image" src="../Uploads/PCM.png" alt="">
                     </a>
               </li>
            </ul><a href="#!" data-target="sidenav-left" class="sidenav-trigger left"><i class="material-icons white-text">menu</i></a>
        </div>
    </nav>
</div>
<ul id="sidenav-left" class="sidenav sidenav-fixed">
<li><a href="dashboard" class="logo-container blue-text">V A I G O</a>
<img src="../Images/PCM.png" class="logo-container ">
</li>
    <li class="no-padding">

        <li><a href="{{route('centerdashboard')}}" class="waves-effect active">Dashboard<i class="material-icons">web</i></a></li>
        <ul class="collapsible collapsible-accordion">
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
                <a href="{{route('logout')}}" class="waves-effect red-text">logout
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
                <a href="" class="waves-effect blue-text">Change Password
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

           