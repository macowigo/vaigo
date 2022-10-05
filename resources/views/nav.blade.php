<header>
    <ul id="sidenav-left" class="sidenav">
            <li><a href="login" class="logo-container blue-text">V A I G O</a>
        <img src="{{asset('Images/vaigo.png')}}" class="logo-container "></li>
            <li class="no-padding">
              <li>
                <a href="{{route('login')}}" class="waves-effect  ">Login
                    <i class="material-icons ">login</i>
                 </a>
                 </li>
                 <li>
                <a href="{{route('passforgot')}}" class="waves-effect ">Forgot Password
                    <i class="material-icons ">lock_reset</i>
                 </a>
                 </li>
            </li>
        </ul>
    </header>
    <nav class="navbar nav-extended no-padding">
        <div class="nav-wrapper">
            <span class="brand-logo"> VAIGO </span>
            <a href="#" data-target="sidenav-left" class="sidenav-trigger">
                <i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right"> </ul> 
        </div>
    </nav>