
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-RegisterCenter</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o&libraries=places"></script>
   <script>
    
function centerlocated(){
    var options={
        componentRestrictions: {country: "TZ"}
    };
    var input=document.getElementById('centerlocation');
    var fromlocation=new google.maps.places.Autocomplete(input,options);
    google.maps.event.addListener(fromlocation, 'place_changed', function () {
        var place = fromlocation.getPlace();
        document.getElementById('fromLat').value = place.geometry.location.lat();
        document.getElementById('fromLng').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', centerlocated);


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
                            <h6 class="blue-text centered-text">Add New Agent Center</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                            @endif
                            @if ($message = Session::get('success'))
                            <h6 class="blue-text centered-text">{{ $message }}</h6>
                            @endif
                            @if ($message = Session::get('failed'))
                            <h6 class="red-text centered-text">{{ $message }}</h6>
                            @endif
                            <form method="POST" action="{{route('addagentlocation')}}">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">adjust</i>
                                        <input id="centername" name="centername" type="text" class="validate" required>
                                        <label for="centername">Region</label>
                                        <span class="helper-text" data-error="please enter valid center names" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">location</i>
                                        <input id="centerlocation" name="centerlocation" type="text" class="validate" required>
                                        <label for="centerlocation">Agent Center Location</label>
                                        <span class="helper-text" data-error="please enter valid center location" data-success="right"></span>
                                    </div>
                                    <input class="btn right blue" type="submit" value="Add">
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