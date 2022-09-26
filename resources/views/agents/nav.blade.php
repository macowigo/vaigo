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

        <li><a href="{{route('agentdshboard')}}" class="waves-effect active">Dashboard<i class="material-icons">web</i></a></li>
        <ul class="collapsible collapsible-accordion">
        <li class="bold waves-effect"><a class="collapsible-header">Regional Orders<i class="material-icons">apartment</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('agentcreateorderview') }}" class="waves-effect">Create Order<i class="material-icons">post_add</i></a></li>
                        <li><a href="{{ route('agenttodayorders') }}" class="waves-effect">Today Orders<i class="material-icons">calendar_today</i></a></li>
                        <li><a href="{{route('agentmonthlyorders')}}" class="waves-effect">{{date('F')}} Orders<i class="material-icons">calendar_month</i></a></li>
                        <li><a href="{{route('agentrgmanage')}}" class="waves-effect">Manage Orders<i class="material-icons">construction</i></a></li>
                    </ul>
                </div>
            </li>
             <li class="bold waves-effect"><a class="collapsible-header">Commisions<i class="material-icons">payments</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{ route('agencommtoday') }}" class="waves-effect">Today Commission<i class="material-icons">money</i></a></li>
                        <li><a href="{{route('agencommonthly')}}" class="waves-effect">{{date('F')}} Commission<i class="material-icons">money</i></a></li>
                    </ul>
                </div>
            </li>
            <li>
             <a href="{{route('changepass')}}" class="waves-effect">ChangePassword<i class="material-icons">lock</i></a>
            </li>
            <li>
             <a href="{{route('ondoka') }}" class="waves-effect red-text" >LogOut
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

           