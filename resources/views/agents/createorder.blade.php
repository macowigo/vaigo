
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-CreateOrder</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

   <script>    
   </script>

</head>
<body class="has-fixed-sidenav">
    <header>
        @include('agents.nav')
    </header>
    {{-- main --}}
    <main>
        <div class="progress" id="loading">
            <div class="indeterminate"></div>
        </div>   
            <div class="container page" style="display: none;">
                <div class="row">
                    <div class="col s12">
                        <div class="receipt-main card-content">
                            <h6 class="blue-text centered-text">Create New Regional Order</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="red-text centered-text" :errors="$errors" />
                            <x-auth-session-status class="red-text centered-text" :status="session('status')" />
                            @if(session('status'))
                            <div class="red-text centered-text">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('failed'))
                            <h6 class="red-text centered-text">{{ $message }}</h6>
                            @endif
                            <form action="POST">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">arrow_forward</i>
                                        <select id="desinationregion" name="desinationregion"class="validate" required >
                                            <option value="" disabled selected>Please select Desination Region</option>
                                            @foreach ($centers as $centerlist)
                                            <option value="{{$centerlist->centerid}}">{{$centerlist->centerlocation.','.$centerlist->centername}}</option> 
                                            @endforeach
                                        </select>
                                        <label for="desinationregion">Desination Region</label>
                                        <span class="helper-text" data-error="please enter your password" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">straighten</i>
                                        <select id="percelsize" name="percelsize"  class="validate" required>
                                        <option value="" disabled selected>Please select Percel Category</option>
                                        <option value="Small">SMALL</option>
                                        <option value="Medium">MEDIUM</option>
                                    </select>
                                    <label for="percelsize">Percel Size</label>
                                    <span class="helper-text" data-error="please select delivery type" data-success="right"></span>
                                  </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">money</i>
                                        <input id="ordervalue" name="ordervalue" type="number" class="validate" required>
                                        <label for="ordervalue">Order value</label>
                                        <span class="helper-text" data-error="please enter valid order value" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">subtitles</i>
                                        <input id="orderdetails" name="orderdetails" type="text" class="validate" >
                                        <label for="orderdetails">Order Details</label>
                                        <span class="helper-text" data-error="please enter valid order details" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="sendernames" name="sendernames" type="text" class="validate" >
                                        <label for="sendernames">Sender names</label>
                                        <span class="helper-text" data-error="please enter valid names" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="senderphone" name="senderphone" type="text" 
                                       pattern="[0]{1}[1-9]{1}[0-9]{8}" class="validate" >
                                        <label for="senderphone">Sender Phone Number</label>
                                        <span class="helper-text" data-error="please enter valid phone number" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="receivernames" name="receivernames" type="text" class="validate" >
                                        <label for="receivernames">Receiver names</label>
                                        <span class="helper-text" data-error="please enter valid names" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="receiverphone" name="receiverphone" type="text" 
                                       pattern="[0]{1}[1-9]{1}[0-9]{8}" class="validate" >
                                        <label for="receiverphone">Receive Phone Number</label>
                                        <span class="helper-text" data-error="please enter valid phone number" data-success="right"></span>
                                    </div>
                                    <input class="btn right blue" type="submit" formmethod="POST" formaction="{{route('createorderregional')}}" value="Create">
                                    <div></div>
                                    <button class="btn left blue" formaction="{{route('agentcalculate')}}" 
                                     formmethod="POST" >GET COST
                                    </button>
                                </div>
                            </form>
                            @if ($message = Session::get('cost'))
                            <div class="blue-text">
                            <p class="blue-text">{{ $message }}</p>
                            </div>
                            @endif
                            @if ($message = Session::get('wronglocations'))
                            <div class="red-text">
                            <p class="red-text">{{ $message }}</p>
                            </div>
                            @endif
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