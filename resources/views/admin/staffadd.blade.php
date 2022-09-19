
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-AddStaff</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o&libraries=places"></script>
   <script>
    
function desinationlocation(){
    var input=document.getElementById('fromlocation');
    var fromlocation=new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(fromlocation, 'place_changed', function () {
        var place = fromlocation.getPlace();
        document.getElementById('fromLat').value = place.geometry.location.lat();
        document.getElementById('fromLng').value = place.geometry.location.lng();
    });
}
    function deliverylocation() {
    var input = document.getElementById('delvlocation');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('delvLat').value = place.geometry.location.lat();
        document.getElementById('delvLng').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', deliverylocation);
google.maps.event.addDomListener(window, 'load', desinationlocation);


   </script>

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
            <div class="container page" style="display: none;">
                <div class="row">
                    <div class="col s12">
                        <div class="receipt-main card-content">
                            <h6 class="blue-text centered-text">Register New User</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('failed'))
                            <div class="red-text">
                            <h6 class="red-text">{{ $message }}</h6>
                            </div>
                            @endif
                            <form method="POST" action="{{route('staffadd')}}">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <select id="role" name="role"class="validate" required>
                                            <option value="" disabled selected>Please select Staff Role</option>
                                            <option value="driver">Driver</option>
                                            <option value="center">Center</option>
                                            <option value="depaturer">Departurer</option>
                                            <option value="agent">Agent</option>
                                        </select>
                                        <label for="role">User Role</label>
                                        <span class="helper-text" data-error="please enter your password" data-success="right"></span>
                                    </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">person</i>
                                            <input id="names" name="names" type="text" class="validate" required>
                                            <label for="names">Full Name</label>
                                            <span class="helper-text" data-error="please enter valid fullname" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">email</i>
                                            <input id="email" name="email" type="email" class="validate" >
                                            <label for="email">Email</label>
                                            <span class="helper-text" data-error="please enter valid location" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">phone</i>
                                            <input id="phone" name="phone" type="text" 
                                           pattern="[0]{1}[1-9]{1}[0-9]{8}" class="validate" required>
                                            <label for="phone">Phone Number</label>
                                            <span class="helper-text" data-error="please enter valid phone number" data-success="right"></span>
                                        </div>
                                    
                                    <div id="center" style="display: none;">
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">adjust</i>
                                            <select name="center" class="validate">
                                             <option value="" disabled selected>Please Select Center</option>
                                             @foreach ($centerlist as $center)
                                             <option value="{{$center->centerid}}">{{$center->centername}}</option>
                                             @endforeach
                                            </select>
                                            <label for="center">Staff Center</label>
                                            <span class="helper-text" data-error="please select valid location" data-success="right"></span>
                                        </div>
                                    </div>
                                    <div id="agent" style="display: none;">
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">support_agent</i>
                                            <select name="center" class="validate">
                                             <option value="" disabled selected>Please Select Center</option>
                                             @foreach ($agentcenterlist as $center)
                                             <option value="{{$center->centerid}}">{{$center->centername}}</option>
                                             @endforeach
                                            </select>
                                            <label for="center">Agent Center Location</label>
                                            <span class="helper-text" data-error="please select valid location" data-success="right"></span>
                                        </div>
                                    </div>
                                    <input class="btn right blue" type="submit" value="REGISTER">
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
       <script src="../JS/selector.js"></script>

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