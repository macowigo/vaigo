
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-SendSMS</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="has-fixed-sidenav">
    <header>
        @include('admin.nav')
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
                            <h6 class="blue-text centered-text">Send SMS to Vaigo individual Customer</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('failed'))
                            <h6 class=" centered-text red-text">{{ $message }}</h6>
                            @endif
                            @if ($message = Session::get('success'))
                            <h6 class=" centered-text blue-text">{{ $message }}</h6>
                            @endif
                            <form method="POST" action="{{route('individualsendsms')}}">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="phone" name="phone" type="text" 
                                       pattern="[0]{1}[1-9]{1}[0-9]{8}" class="validate" required>
                                        <label for="phone">Phone Number</label>
                                        <span class="helper-text" data-error="please enter valid phone number" data-success="right"></span>
                                    </div>
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">sms</i>
                                            <textarea id="sms" class="materialize-textarea validate" name="sms" required></textarea>
                                            <label for="sms">SMS To Send</label>
                                            <span class="helper-text" data-error="please write valid sms" data-success="right"></span>
                                        </div>
                                    <input class="btn right blue" type="submit" value="SEND">
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