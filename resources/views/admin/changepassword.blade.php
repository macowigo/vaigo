
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-ChangePassword</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="has-fixed-sidenav">
    <header>
        
        @if (Auth::user()->role=="admin")
        @include('admin.nav') 
        @endif

        @if(Auth::user()->role=="depaturer")
        @include('departurer.nav')
        @endif
        
        @if(Auth::user()->role=="center")
        @include('centers.nav') 
        @endif

        @if(Auth::user()->role=="agent")
        @include('agents.nav') 
        @endif
        
    </header>
    {{-- main --}}
    <main>
        <div class="progress" id="loading">
            <div class="indeterminate"></div>
        </div>   
            <div class="container-register page" style="display: none;">
                <div class="row">
                    <div class="col s12">
                        <div class="receipt-main card-content">
                            <h6 class="blue-text centered-text">Change Pasword</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('success'))
                            <h6 class="blue-text">{{ $message }}</h6>
                            @endif
                            {{-- failed --}}
                            @if ($message=Session::get('failed'))
                            <h6 class="red-text">{{ $message }}</h6>
                            @endif
                            <form method="POST" action="{{route('changepassword')}}">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">lock</i>
                                        <input id="oldpassword" name="oldpassword" type="password" class="validate" required>
                                        <label for="oldpassword">Current Password</label>
                                        <span toggle="#oldpassword" class="field-icon toggle-password">
                                        <span class="material-icons">visibility</span></span>
                                        <span class="helper-text" data-error="please enter valid Current password" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">lock_reset</i>
                                        <input id="password" name="password" type="password" class="validate" minlength="8" required>
                                        <label for="password">New Password</label>
                                        <span toggle="#password" class="field-icon toggle-password">
                                            <span class="material-icons">visibility</span></span>
                                        <span class="helper-text" data-error="please enter valid new password" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">lock_reset</i>
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="validate" minlength="8" required>
                                        <label for="password_confirmation">Confirm Password</label>
                                        <span toggle="#password_confirmation" class="field-icon toggle-password">
                                            <span class="material-icons">visibility</span></span>
                                        <span class="helper-text" data-error="please confirm new password" data-success="right"></span>
                                    </div>
                                    <input class="btn right blue" type="submit" value="CHANGE PASSWORD">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
       <!-- Scripts -->
       <script src="../JS/jquery.min.js"></script>
       <script src="../JS/moment.min.js"></script>

       <script type="text/javascript" src="../JS/Chart.js"></script>
       <script type="text/javascript" src="../JS/Chart.Financial.js"></script>
       <script src="../JS/fullcalendar.min.js"></script>
       <script 
       type="text/javascript" src="../JS/datatables.min.js"></script>
       <script src="../JS/imagesloaded.pkgd.min.js"></script>
       <script src="../JS/masonry.pkgd.min.js"></script>

       <!-- Initialization script -->
       <script src="../JS/admin-materialize.min.js"></script>
       <script src='../JS/preloader.js'></script>

</body>
</html>