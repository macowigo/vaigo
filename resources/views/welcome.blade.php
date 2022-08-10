
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-Login</title>
    <link rel="shortcut icon" href="../Images/PCM.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../CSS/icon.css" rel="stylesheet">
</head>
<body>
  @include('nav')
    <main>
    <div class="progress" id="loading">
      <div class="indeterminate"></div>
  </div>
<div class="container-login page" style="display: none;">
            <div class="row">
                <div class=" col s12 ">
                <div class="receipt-main card-content" >
<img src="../Images/PCM.png" class="image-center">
<h6 class="brand-logo blue-text centered-text"> VAIGO LOGIN </h6>
<br>
<br>
    <h6 class=" centered-text card-title">Enter Your Credentials to LogIn</h6>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form method="POST" action="{{ route('login') }}" >
        @csrf
        <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
            <input id="email" name="email" type="email" class="validate"  required>
            <label for="email" >Username</label>
            <span class="helper-text" data-error="Please enter Valid email Address" data-success="right"></span>
        </div>
        <div class="input-field">
        <i class="material-icons prefix">lock</i>
            <input id="password"  name="password" type="password" class="validate" required>
            <label for="password">Password</label>
            <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>

            <span class="helper-text" data-error="please enter your password" data-success="right"></span>
        </div>

        <a href="forgot_pass">Forgot Password?</a>
        <br><br>
        <a href="{{route('register')}}">Dont Have Account? Register</a>
            <input class="btn right blue" type="submit" value="Log In">
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