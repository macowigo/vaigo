
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
<body>
        <nav class="navbar nav-extended no-padding">
            <div class="nav-wrapper">
                <span class="brand-logo"> VAIGO </span>
            </div>
        </nav>
    <main>
    <div class="progress" id="loading">
      <div class="indeterminate"></div>
  </div>
<div class="container-login page" style="display: none;">
            <div class="row">
                <div class=" col s12 ">
                <div class="receipt-main card-content" >

<h6 class="brand-logo blue-text centered-text"> VAIGO PASSWORD RECOVERY</h6>
<h6 class=" centered-text card-title">Change Password</h6>
@if ($message = Session::get('failed'))
<h6 class="centered-text red-text">{{ $message }}</h6>
@endif
@if ($message = Session::get('success'))
<h6 class="centered-text blue-text">{{ $message }}</h6>
@endif
    <x-auth-validation-errors class="centered-text" :errors="$errors" />
    <form method="POST" action="{{route('changepassword')}}">
        @csrf
        <div class=" row">
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
    <script src="../JS/preloader.js"></script>
    

    <!-- External libraries -->
    <script type="text/javascript" src="../JS/Chart.js"></script>
<script type="text/javascript" src="../JS/Chart.Financial.js"></script>


    <script src="../JS/fullcalendar.min.js"></script>
    <script type="text/javascript" src="../JS/datatables.min.js"></script>
    <!-- <script src="../JS/imagesloaded.pkgd.min.js"></script> -->
    <script src="../JS/masonry.pkgd.min.js"></script>

    <!-- Initialization script -->
    <script src="../JS/admin-materialize.min.js"></script>
</body>
</html>