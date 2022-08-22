
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="">
    <title>VAIGO-RegisterVendor</title>
    <link rel="shortcut icon" href="../Images/vaigo.png">
    <link href="../CSS/vaigo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFnY0qEUXZW-efcSTWmQ2Ga7te_pNsA4o&libraries=places"></script>
   <script>
    
function vendorstation(){
    var options={componentRestrictions: {country: "TZ"}};
    var input=document.getElementById('vendorlocation');
    var vendorlocation=new google.maps.places.Autocomplete(input,options);
    google.maps.event.addListener(vendorlocation, 'place_changed', function () {
        var place = vendorlocation.getPlace();
        document.getElementById('vendorLat').value = place.geometry.location.lat();
        document.getElementById('vendorLng').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', vendorstation);


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
                            <h6 class="blue-text centered-text">Register New Vendor</h6>
                            {{-- errors --}}
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if(session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                            </div>
                            @endif
                            {{-- succes notify --}}
                            @if ($message = Session::get('succes'))
                            <div class="blue-text">
                                <h6 class="blue-text">{{ $message }}</h6>
                            </div>
                            @endif
                            {{-- failed notify --}}
                            @if ($message = Session::get('failed'))
                            <div class="red-text">
                            <h6 class="red-text">{{ $message }}</h6>
                            </div>
                            @endif
                            <form method="POST" action="{{route('addvendor')}}">
                                @csrf
                                <div class=" row">
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="vendornames" name="vendornames" type="text" class="validate" required>
                                        <label for="vendornames">Vendor Names</label>
                                        <span class="helper-text" data-error="please enter vendor names" data-success="right"></span>
                                    </div>
                                    <div class="input-field col s12 m12 l6">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="phone" name="phone" type="text" 
                                       pattern="[0]{1}[1-9]{1}[0-9]{8}" class="validate" required>
                                        <label for="phone">Vendor Phone Number</label>
                                        <span class="helper-text" data-error="please enter valid phone number" data-success="right"></span>
                                    </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">location_on</i>
                                            <input id="vendorlocation" name="vendorlocation" type="text" class="validate" required >
                                            <label for="vendorlocation">Vendor location</label>
                                            <input type="hidden" id="vendorLat" name="vendorLat" />
                                            <input type="hidden" id="vendorLng" name="vendorLng" />
                                            <span class="helper-text" data-error="please select valid location" data-success="right"></span>
                                        </div>
                                        <div class="input-field col s12 m12 l6">
                                            <i class="material-icons prefix">adjust</i>
                                            <select name="vendorcenter" class="validate" required>
                                             <option value="" disabled selected>Please Select Center</option>
                                             @foreach ($centerlist as $center)
                                             <option value="{{$center->centerid}}">{{$center->centername}}</option>
                                             @endforeach
                                            </select>
                                            <label for="vendorcenter">Vendor Center</label>
                                            <span class="helper-text" data-error="please select valid location" data-success="right"></span>
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